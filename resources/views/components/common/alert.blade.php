@if (session('success'))
    <div class="fixed top-4 right-4 z-50 max-w-sm
               alert alert-soft alert-success
               removing:translate-x-5 removing:opacity-0
               flex items-center gap-4
               transition duration-300 ease-in-out"
        role="alert" id="dismiss-alert-success" x-data x-init="setTimeout(() => {
            document.querySelector('[data-remove-element=\'#dismiss-alert-success\']')?.click()
        }, 3000)">
        <span class="icon-[tabler--circle-check] size-5"></span>

        <p>{{ session('success') }}</p>

        <button class="ms-auto cursor-pointer leading-none" data-remove-element="#dismiss-alert-success"
            aria-label="Close Button">
            <span class="icon-[tabler--x] size-5"></span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="fixed top-4 right-4 z-50 max-w-sm
               alert alert-soft alert-error
               removing:translate-x-5 removing:opacity-0
               flex items-center gap-4
               transition duration-300 ease-in-out"
        role="alert" id="dismiss-alert-error" x-data x-init="setTimeout(() => {
            document.querySelector('[data-remove-element=\'#dismiss-alert-error\']')?.click()
        }, 3000)">
        <span class="icon-[tabler--alert-triangle] size-5"></span>

        <p>{{ session('error') }}</p>

        <button class="ms-auto cursor-pointer leading-none" data-remove-element="#dismiss-alert-error"
            aria-label="Close Button">
            <span class="icon-[tabler--x] size-5"></span>
        </button>
    </div>
@endif
