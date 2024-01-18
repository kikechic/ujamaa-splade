<div class="flex flex-col w-full h-screen font-normal bg-slate-100">
	<x-navigation />
	<div class="flex flex-row h-[100vh_-_4rem_-_4rem] overflow-hidden">
		<x-sidebar />
		<x-splade-modal name="sidebar-modal" slideover position="left">
			<x-sidebar />
		</x-splade-modal>
		<main class="h-inherit flex-grow overflow-auto">
			{{ $slot }}
		</main>
	</div>
	<x-footer />
</div>