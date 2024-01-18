<div class="flex flex-col h-screen w-screen font-normal bg-slate-100">
	<x-navigation />
	<div class="flex flex-row h-screen overflow-hidden">
		<div class="hidden lg:block h-[calc(100vh_-_8rem)] overflow-y-auto shadow-md bg-slate-50 pt-5">
			<x-sidebar />
		</div>
		<x-splade-modal name="sidebar-modal" slideover position="left">
			<x-sidebar />
		</x-splade-modal>
		<main class="h-[inherit] flex-grow overflow-auto">
			{{ $slot }}
		</main>
	</div>
	<x-footer />
</div>