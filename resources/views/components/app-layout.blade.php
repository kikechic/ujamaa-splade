<div class="flex flex-col w-full h-screen font-normal bg-slate-100">
	<x-sidebar />

	<x-navigation />

	<main class="h-[100vh_-_4rem_-_4rem] flex-grow overflow-auto">
		{{ $slot }}
	</main>

	<x-footer />
</div>
