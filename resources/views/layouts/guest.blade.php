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

<body class="bg-base-200">
    <div class="flex h-auto min-h-screen items-center justify-center overflow-x-hidden py-10">
        <div class="relative flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div
                class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:min-w-md lg:p-8">
                <div class="flex items-center gap-3">
                    <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="h-8"
                        alt="brand-logo" />
                    <h2 class="text-base-content text-xl font-bold">{{ config('app.name') }}</h2>
                </div>
                <div>
                    @isset($heading)
                        <h3 class="text-base-content mb-1.5 text-2xl font-semibold">{{ $heading ?? '' }}</h3>
                    @endisset

                    @isset($subheading)
                        <p class="text-base-content/80">{{ $subheading ?? '' }}</p>
                    @endisset
                </div>
                <div class="space-y-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
