<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&ampdisplay=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme Script -->
    <script type="text/javascript">
        (function() {
            try {
                const root = document.documentElement;
                const savedTheme = localStorage.getItem('theme') || 'light';
                root.setAttribute('data-theme', savedTheme);
            } catch (e) {
                console.warn('Early theme script error:', e);
            }
        })();
    </script>
</head>

<body>
    <div class="bg-base-100 flex min-h-screen flex-col">
        <x-layouts.header />
        <x-layouts.sidebar />

        <div class="flex grow flex-col lg:ps-75">
            <header>
                {{ $header ?? '' }}
            </header>
            <!-- ---------- MAIN CONTENT ---------- -->
            <main class="w-full h-[calc(100vh-var(--header-height))] overflow-y-auto overflow-x-auto">
                {{ $slot }}
            </main>
            <!-- ---------- END MAIN CONTENT ---------- -->
        </div>
    </div>

    <x-common.delete-modal />

    @stack('scripts')

    <script>
        function updateMainHeight() {
            const topnav = document.querySelector('#topnav');
            const header = document.querySelector('header');
            const main = document.querySelector('#main');
            const height = topnav.offsetHeight + header.offsetHeight;
            document.documentElement.style.setProperty('--header-height', height + 'px');
        }

        // Run on load/resize
        window.addEventListener('load', updateMainHeight);
        window.addEventListener('resize', updateMainHeight);
    </script>
</body>

</html>
