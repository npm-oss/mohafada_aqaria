@echo off
chcp 65001 >nul
echo ========================================
echo   Firebase App Server
echo ========================================
echo.

REM Check for PHP
where php >nul 2>nul
if %ERRORLEVEL% EQU 0 (
    echo [*] PHP found - Starting server...
    echo [*] Open browser at: http://localhost:8000
    echo [*] Client: http://localhost:8000/index.html
    echo [*] Admin: http://localhost:8000/admin/login.html
    echo [*] Test: http://localhost:8000/test-connection.html
    echo.
    echo [*] Press Ctrl+C to stop server
    echo.
    php -S localhost:8000
    goto :end
)

REM Check for Python
where python >nul 2>nul
if %ERRORLEVEL% EQU 0 (
    echo [*] Python found - Starting server...
    echo [*] Open browser at: http://localhost:8000
    echo [*] Client: http://localhost:8000/index.html
    echo [*] Admin: http://localhost:8000/admin/login.html
    echo [*] Test: http://localhost:8000/test-connection.html
    echo.
    echo [*] Press Ctrl+C to stop server
    echo.
    python -m http.server 8000
    goto :end
)

REM No server found
echo [!] ERROR: PHP or Python not found
echo [!] Please install one of them to run the server
echo.
pause

:end
