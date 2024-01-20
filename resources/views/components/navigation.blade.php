<nav class="bg-gray-50 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">

        <div class="w-10 ">
            <x-splade-link class="block lg:hidden" href="#sidebar-modal">
                <x-lucide-menu class="h-6 w-6" />
            </x-splade-link>
        </div>

        <div class="flex items-center space-x-4">

            <span class="text-gray-600">Welcome, {{ auth()->user()->name }}</span>

            <x-splade-link :href="route('logout')" method="POST" confirm confirm-text="Logout?"
                class="text-gray-600 hover:underline hover:text-red-500 flex items-center">
                <span class="mr-2">
                    <x-lucide-log-out class="h-4 w-4" />
                </span>
                Logout
            </x-splade-link>
        </div>
    </div>
</nav>
