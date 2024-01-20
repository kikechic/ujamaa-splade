<nav class="bg-gray-50 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">

        <x-splade-link :href="route('home')" class="text-primary-500 text-xl font-bold">
            Timesheets
        </x-splade-link>

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
