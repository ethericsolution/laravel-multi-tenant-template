@if ($errors->any())
    <div class="alert alert-soft alert-error flex items-start gap-4 removing:translate-x-5 removing:opacity-0 transition duration-300 ease-in-out"
        role="alert" id="dismiss-alert1">
        <span class="icon-[tabler--info-circle] shrink-0 size-6"></span>

        <div class="flex flex-col gap-1">
            <h5 class="text-lg font-semibold">Validation Errors:</h5>
            <ul class="mt-1.5 list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <button type="button" class="ms-auto cursor-pointer leading-none" data-remove-element="#dismiss-alert1"
            aria-label="Close Button">
            <span class="icon-[tabler--x] size-5"></span>
        </button>
    </div>

@endif
