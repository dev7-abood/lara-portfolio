<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Contact;
use App\Http\Resources\ApiV1\ContactResource;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $contact = Contact::query()
            ->where('is_public', true)
            ->first();

        return response()->json([
            'status' => (bool) $contact,
            'message' => $contact ? 'Contact found' : 'No public contact available',
            'data' => $contact ? new ContactResource($contact) : null,
        ]);
    }

    /**
     * Store a new contact message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'message' => 'required|string',
        ]);

        // Save the data to the database
        ContactUs::query()->create($validatedData);

        // Gather additional details
        $requesterIp = $request->ip();
        $locationData = $this->getLocationData($requesterIp);

        // Notify via Telegram with enhanced details
        $this->notifyTelegram($validatedData, $requesterIp, $locationData);

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Thanks for contacting us! We will get back to you soon.',
        ], 201);
    }

    /**
     * Send the contact message details to Telegram.
     *
     * @param  array  $data
     * @param  string  $ip
     * @param  array|null  $locationData
     * @return void
     */
    private function notifyTelegram(array $data, string $ip, ?array $locationData): void
    {
        $telegramToken = config('telegram.bot_token');
        $telegramApiUrl = 'https://api.telegram.org/bot' . $telegramToken . '/sendMessage';

        // Combine firstname and lastname to create the full name
        $fullName = $data['firstname'] . ' ' . $data['lastname'];

        // Format location details
        $locationDetails = $locationData
            ? sprintf(
                "🌍 *Location Details:*\n" .
                "*Country:* %s (%s)\n" .
                "*Region:* %s\n" .
                "*City:* %s\n" .
                "*ISP:* %s\n" .
                "*Organization:* %s\n",
                $locationData['country'] ?? 'Unknown',
                $locationData['countryCode'] ?? 'N/A',
                $locationData['regionName'] ?? 'Unknown',
                $locationData['city'] ?? 'Unknown',
                $locationData['isp'] ?? 'Unknown ISP',
                $locationData['org'] ?? 'Unknown Organization'
            )
            : "🌍 *Location Details:*\nUnable to determine.\n";

        // Format the message
        $telegramMessage = sprintf(
            "📬 *New Contact Message Received:*\n\n" .
            "*Full Name:* %s\n" .
            "*Service:* %s\n" .
            "*Email:* %s\n" .
            "*Phone:* %s\n" .
            "*Message:* %s\n\n" .
            "📍 *IP Address:* %s\n\n" .
            $locationDetails,
            $fullName,
            $data['service'],
            $data['email'],
            $data['phone'],
            $data['message'],
            $ip
        );

        // Send the message via HTTP
        Http::post($telegramApiUrl, [
            'chat_id' => config('telegram.chat_id'), // Set the chat ID in the .env file
            'text' => $telegramMessage,
            'parse_mode' => 'Markdown',
        ]);
    }

    /**
     * Get location data based on IP address.
     *
     * @param  string  $ip
     * @return array|null
     */
    private function getLocationData(string $ip): ?array
    {
        try {
            $response = Http::get("http://ip-api.com/json/$ip");
            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            // Handle exception (e.g., log the error)
        }

        return null;
    }
}
