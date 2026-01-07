<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #1e1b4b 100%);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 800px;
            height: 800px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transform: translate(40%, -40%);
        }

        body::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transform: translate(-40%, 40%);
        }

        .auth-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative" style="z-index: 1;">
        <div class="mb-8">
            <a href="/" class="flex items-center gap-3 text-white hover:scale-110 transition-transform duration-300">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-2xl">
                    <i class="bi bi-mortarboard-fill text-4xl" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold drop-shadow-lg">Kursus Online</div>
                    <div class="text-sm opacity-90">Learning Management System</div>
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 auth-card">
            {{ $slot }}
        </div>

        <div class="mt-6 text-center text-white text-sm opacity-75">
            <p>&copy; 2026 Sistem Manajemen Kursus Online</p>
        </div>
    </div>
</body>

</html>