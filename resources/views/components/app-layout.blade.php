<div class="flex flex-col h-screen w-screen font-normal bg-slate-100">
    <x-navigation />
    <div class="flex flex-row h-[calc(100vh_-_4rem)] overflow-hidden">
        <div class="hidden lg:block h-[inherit] text-sm w-64 border-t overflow-y-auto shadow-md bg-slate-50 pt-5 pb-2">
            <x-sidebar />
        </div>
        <x-splade-modal name="sidebar-modal" slideover position="left">
            <x-sidebar />
        </x-splade-modal>
        <main class="h-[inherit] flex-grow overflow-auto">
            {{ $slot }}
        </main>
    </div>
    {{-- <x-footer /> --}}
</div>
