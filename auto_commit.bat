@echo off
:loop
rem Change to the directory of your repository
cd /d "C:\path\to\your\repo"

rem Stage all changes
git add .

rem Commit with a timestamp
git commit -m "Auto-commit: %date% %time%"

rem Wait for 60 seconds before checking again
timeout /t 100 /nobreak

rem Loop back and check again
goto loop
