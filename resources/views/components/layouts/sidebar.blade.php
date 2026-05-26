@php
    $navigation = $mainNav = [
        [
            'name' => __('Dashboard'),
            'route' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
            'icon' => '<span class="icon-[tabler--layout-dashboard] size-4.5"></span>',
        ],
        [
            'name' => __('Invoices'),
            'route' => route('billing.invoices.index'),
            'active' => request()->routeIs('billing.invoices.*'),
            'icon' => '<span class="icon-[tabler--file] size-4.5"></span>',
        ],
    ];
@endphp

<!-- ---------- MAIN SIDEBAR ---------- -->
<aside id="layout-toggle"
    class="overlay overlay-open:translate-x-0 drawer drawer-start inset-y-0 inset-s-0 hidden h-full [--auto-close:lg] sm:w-75 lg:z-50 lg:block lg:translate-x-0 lg:shadow-none"
    aria-label="Sidebar" tabindex="-1">
    <div class="drawer-body border-base-content/20 h-full border-e p-0">
        <div class="flex h-full max-h-full flex-col">
            <button type="button" class="btn btn-text btn-circle btn-sm absolute inset-e-3 top-3 lg:hidden"
                aria-label="Close" data-overlay="#layout-toggle">
                <span class="icon-[tabler--x] size-5"></span>
            </button>
            <div class="text-base-content flex flex-col items-center gap-4 px-4 py-6">
                <div class="flex flex-1 items-center">
                    <a class="link text-base-content link-neutral text-xl font-semibold no-underline"
                        href="{{ route('dashboard') }}">
                        <div class="flex items-center gap-3">
                            <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="size-8"
                                alt="brand-logo" />
                            <h2 class="text-base-content text-xl font-bold whitespace-nowrap">{{ config('app.name') }}
                            </h2>
                        </div>
                    </a>
                </div>
            </div>
            <div class="h-full overflow-y-auto">
                <ul class="menu menu-sm gap-1 px-4">
                    @foreach ($navigation as $item)
                        {{-- GROUP --}}
                        @if (isset($item['group']))
                            <li class="text-base-content/50 mt-2.5 p-2 text-xs uppercase">{{ $item['group'] }}</li>
                            @continue
                        @endif

                        {{-- MENU ITEM --}}
                        <li>
                            <a href="{{ $item['route'] }}" class="px-2 {{ $item['active'] ? 'menu-active' : '' }}">
                                {!! $item['icon'] !!}
                                {{ $item['name'] }}
                            </a>

                            {{-- @isset($item['quickAdd'])
                                <a href="{{ $item['quickAdd'] }}" class="btn btn-circle btn-primary">
                                    <span class="icon-[tabler--plus] size-3.5"></span>
                                </a>
                            @endisset --}}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-auto space-y-3 p-4">
                <p class="text-base-content text-center">
                    &copy; Developed by
                    <a href="https://ethericsolution.com/" target="_blank"
                        class="text-primary">{{ __('Etheric Solution') }}</a>
                </p>
            </div>
        </div>
    </div>
</aside>
<!-- ---------- END MAIN SIDEBAR ---------- -->
