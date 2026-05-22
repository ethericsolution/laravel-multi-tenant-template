<!-- ---------- HEADER ---------- -->
<div class="bg-base-100 border-base-content/20 sticky top-0 z-50 flex border-b lg:ps-75" id="topnav">
    <div class="w-full">
        <nav class="navbar py-2">
            <div class="navbar-start gap-2">
                <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-toggle" data-overlay="#layout-toggle">
                    <span class="icon-[tabler--menu-2] size-4.5"></span>
                </button>

                <!-- Search  -->
                <button type="button"
                    class="max-sm:btn max-sm:btn-text max-sm:btn-sm max-sm:btn-square flex items-center gap-2 text-sm"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="search-modal"
                    data-overlay="#search-modal">
                    <span class="icon-[tabler--search] text-base-content size-4.5"></span>
                    <span class="text-base-content/50 max-sm:hidden">Search [CTRL + K]</span>
                </button>
            </div>

            <div class="navbar-end gap-6">
                <div class="flex items-center">
                    <!-- Theme Dropdown -->
                    <div class="dropdown relative inline-flex [--offset:24]">
                        <button id="dropdown-theme" type="button"
                            class="dropdown-toggle btn btn-sm btn-square btn-text" aria-haspopup="menu"
                            aria-expanded="false" aria-label="Dropdown">
                            <span id="icon-system" class="icon-[tabler--sun-moon] size-4.5"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-50" role="menu"
                            aria-orientation="vertical" aria-labelledby="dropdown-theme">
                            <li>
                                <input type="radio" name="theme-dropdown"
                                    class="theme-controller btn btn-text w-full justify-start" aria-label="Light"
                                    value="light" />
                            </li>
                            <li>
                                <input type="radio" name="theme-dropdown"
                                    class="theme-controller btn btn-text w-full justify-start" aria-label="Dark"
                                    value="dark" />
                            </li>
                            <li>
                                <input type="radio" name="theme-dropdown"
                                    class="theme-controller btn btn-text w-full justify-start" aria-label="System"
                                    value="default" />
                            </li>
                        </ul>
                    </div>

                    <!-- Language Dropdown -->
                    <div class="dropdown relative inline-flex [--offset:24]">
                        <button id="language-dropdown" type="button"
                            class="dropdown-toggle btn btn-sm btn-square btn-text" aria-haspopup="menu"
                            aria-expanded="false" aria-label="Dropdown">
                            <span class="icon-[tabler--language] size-4.5"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-60 space-y-0.5"
                            role="menu" aria-orientation="vertical" aria-labelledby="language-dropdown">
                            <li><a class="dropdown-item px-3" href="#">English</a></li>
                            <li><a class="dropdown-item dropdown-active px-3" href="#">Deutsch</a></li>
                            <li><a class="dropdown-item px-3" href="#">한국인</a></li>
                            <li><a class="dropdown-item px-3" href="#">Española</a></li>
                            <li><a class="dropdown-item px-3" href="#">Português</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="dropdown relative inline-flex [--offset:21]">
                    <button id="profile-dropdown" type="button" class="dropdown-toggle avatar" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">
                        <span class="rounded-field size-9.5">
                            <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg"
                                alt="User Avatar" />
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-75 space-y-0.5"
                        role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown">
                        <li class="dropdown-header mb-1 gap-4 px-5 pt-4.5 pb-3.5">
                            <div class="avatar avatar-online-top">
                                <div class="w-10 rounded-full">
                                    <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg"
                                        alt="avatar" />
                                </div>
                            </div>
                            <div>
                                <h6 class="text-base-content mb-0.5 font-semibold">{{ Auth::user()->name }}</h6>
                                <p class="text-base-content/80 font-medium">{{ Auth::user()->email }}</p>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="{{ route('profile.edit') }}">
                                <span class="icon-[tabler--user] size-5"></span>
                                {{ __('Your Account') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--settings] size-5"></span>
                                Setting
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--credit-card] size-5"></span>
                                Billing
                            </a>
                        </li>
                        <li class="dropdown-footer p-2 pt-1">
                            <form action="{{ route('app.logout') }}" method="post" class="w-full">
                                @csrf
                                <button class="btn btn-error btn-soft btn-block">
                                    <span class="icon-[tabler--logout] size-5"></span>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Search Dropdown Content  -->
<div id="search-modal" class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 modal-middle hidden"
    role="dialog" tabindex="-1">
    <div class="modal-dialog w-full max-w-145">
        <div class="modal-content overflow-auto shadow-none">
            <!-- SearchBox -->
            <div class="modal-header border-base-content/20 border-b px-3 py-2">
                <div class="input no-focus border-0 px-0">
                    <span class="icon-[tabler--search] text-base-content/80 my-auto me-2 size-5 shrink-0"></span>
                    <input type="search" class="grow" placeholder="Search here..." id="kbdInput" />
                    <label class="sr-only" for="kbdInput">Search</label>
                </div>
            </div>

            <!-- Footer Commands -->
            <div class="modal-footer border-base-content/20 text-base-content/50 gap-4 border-t py-4 max-sm:hidden">
                <div class="flex grow items-center gap-2 text-sm">
                    <kbd class="kbd kbd-sm">esc</kbd>
                    <span>To close</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <kbd class="kbd kbd-sm p-0"><span class="icon-[tabler--arrow-back] size-4"></span></kbd>
                    <span>To Select</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <kbd class="kbd kbd-sm p-0"><span class="icon-[tabler--arrow-up] size-4"></span></kbd>
                    <kbd class="kbd kbd-sm p-0"><span class="icon-[tabler--arrow-down] size-4"></span></kbd>
                    <span>To Navigate</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------- END HEADER ---------- -->
