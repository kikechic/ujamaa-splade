<Dropdown class="w-full">
	<template #trigger>
		<button
			class="inline-flex h-full w-full justify-center text-center"
			type="button"
		>
			<x-lucide-more-horizontal class="h-4 w-full self-center" />
		</button>
	</template>
	<div
		class="flex flex-col justify-start gap-3 whitespace-nowrap rounded-md bg-white p-4 shadow-md"
		role="menu"
	>
		{{ $slot }}
	</div>
</Dropdown>
