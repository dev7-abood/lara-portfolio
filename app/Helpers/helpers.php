<?php

if (!function_exists('prefixedAssetUrl')) {
    /**
     * Get the full URL of a file with a specified storage prefix or return null if the file is null.
     * If the file path already contains the storage prefix, it won't add it again.
     *
     * @param string|null $filePath
     * @param string $storagePrefix
     * @return string|null
     */
    function prefixedAssetUrl(?string $filePath, string $storagePrefix = 'storage'): ?string
    {
        if (is_null($filePath)) {
            return null;
        }

        // Check if the file path already contains the storage prefix
        if (str_starts_with($filePath, $storagePrefix)) {
            return config('app.url') . '/' . ltrim($filePath, '/');
        }

        // Get the current domain URL
        $baseUrl = config('app.url') ?? request()->getSchemeAndHttpHost();

        // Concatenate the storage prefix with the file path
        return $baseUrl . '/' . trim($storagePrefix, '/') . '/' . ltrim($filePath, '/');
    }
}
