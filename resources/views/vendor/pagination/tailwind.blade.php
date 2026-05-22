@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4">

        {{-- Page details --}}
        <div class="me-2 block max-w-sm text-base-content/80 sm:mb-0">
            Total Count : <span class="font-semibold">{{ $paginator->total() }}</span>
        </div>

        {{-- Pagination --}}
        <nav class="flex items-center gap-x-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="btn btn-text btn-square cursor-not-allowed opacity-50">
                    <span class="icon-[tabler--chevron-left] size-5 rtl:rotate-180"></span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-text btn-square">
                    <span class="icon-[tabler--chevron-left] size-5 rtl:rotate-180"></span>
                </a>
            @endif

            @if ($paginator->firstItem())
                <span class="text-base-content/80">
                    {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}
                </span>
            @else
                <span class="text-base-content/80">{{ $paginator->count() }}</span>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-text btn-square">
                    <span class="icon-[tabler--chevron-right] size-5 rtl:rotate-180"></span>
                </a>
            @else
                <span class="btn btn-text btn-square cursor-not-allowed opacity-50">
                    <span class="icon-[tabler--chevron-right] size-5 rtl:rotate-180"></span>
                </span>
            @endif

        </nav>
    </div>
@endif
