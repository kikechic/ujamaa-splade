<div class="flex flex-col w-full h-screen font-normal bg-slate-100">
	<x-navigation />
	<div class="flex flex-row h-[100vh_-_4rem_-_4rem] overflow-hidden">
		<div class="hidden lg:block h-inherit overflow-y-auto shadow-sm bg-white pt-5">
			<x-sidebar />
		</div>
		<x-splade-modal name="sidebar-modal" slideover position="left">
			<x-sidebar />
		</x-splade-modal>
		<main class="h-[100vh_-_4rem_-_4rem] flex-grow overflow-auto">
			{{ $slot }}
		</main>
	</div>
	<x-footer />
</div>