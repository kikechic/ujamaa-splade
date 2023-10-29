<div v-show="@js($searchInput->value !== null) || table.isForcedVisible(@js($searchInput->key))" class="px-4 sm:px-0">
    <div class="relative flex mt-3 rounded-md shadow-sm">
        <label for="{{ $searchInput->key }}"
            class="inline-flex items-center px-4 text-xs text-gray-500 border border-r-0 border-gray-300 rounded-l-md bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>

            <span>{{ $searchInput->label }}</span>
        </label>

        <input name="searchInput-{{ $searchInput->key }}" value="{{ $searchInput->value }}" type="text"
            class="flex-1 block w-full min-w-0 px-3 py-2 text-xs border-gray-300 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500"
            v-bind:class="{ 'opacity-50': table.isLoading }" v-bind:disabled="table.isLoading"
            @input="table.debounceUpdateQuery('filter[{{ $searchInput->key }}]', $event.target.value, $event.target)" />

        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <button
                class="text-gray-400 rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                @click.prevent="table.disableSearchInput(@js($searchInput->key))"
                dusk="remove-search-row-{{ $searchInput->key }}">
                <span class="sr-only">{{ __('Remove search') }}</span>

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>
