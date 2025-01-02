<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My Blog' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-indigo-600">My Blog</a>
            <nav class="space-x-4">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600">Home</a>
                <a href="{{ route('blogs.index') }}" class="text-gray-700 hover:text-indigo-600">Blog</a>
                @auth
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-gray-700 hover:text-indigo-600">Manage your account</a>
                @endauth
                @guest
                    <a href="{{ route('filament.admin.auth.register') }}" class="text-gray-700 hover:text-indigo-600">Want to join?</a>
                    <a href="{{ route('filament.admin.auth.login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                @endguest
            </nav>
        </div>
    </header>

    <main class="flex-grow py-8">
        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} My Blog. All rights reserved.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
