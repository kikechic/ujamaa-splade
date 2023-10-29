<div class="flex h-[inherit] w-full flex-row bg-slate-100 font-normal">
	<x-sidebar />
	<div class="ml-64 flex h-screen grow flex-col">
		<x-navigation />
		<main class="h-screen w-full grow overflow-auto">
			{{ $slot }}
		</main>
		<x-footer />
	</div>
</div>
