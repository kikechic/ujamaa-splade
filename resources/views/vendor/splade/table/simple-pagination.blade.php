<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between px-4 py-3 sm:px-0">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span
            class="relative inline-flex items-center px-4 py-2 text-xs font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default sm:text-xs">
            {!! __('pagination.previous') !!}
        </span>
    @else
        <a @click.exact.prevent="table.navigate(@js($paginationUrl = $paginator->previousPageUrl()), true)" dusk="pagination-simple-previous"
            href="{{ $paginationUrl }}" rel="prev"
            class="relative inline-flex items-center px-4 py-2 text-xs font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md sm:text-xs hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
            {!! __('pagination.previous') !!}
        </a>
    @endif

    @includeWhen($hasPerPageOptions ?? true, 'splade::table.per-page-selector')

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a @click.exact.prevent="table.navigate(@js($paginationUrl = $paginator->nextPageUrl()), true)" dusk="pagination-simple-next"
            href="{{ $paginationUrl }}" rel="next"
            class="relative inline-flex items-center px-4 py-2 text-xs font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md sm:text-xs hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
            {!! __('pagination.next') !!}
        </a>
    @else
        <span
            class="relative inline-flex items-center px-4 py-2 text-xs font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default sm:text-xs">
            {!! __('pagination.next') !!}
        </span>
    @endif
</nav>
