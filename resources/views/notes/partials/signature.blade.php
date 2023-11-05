<x-section-border />

<div class="inline-flex w-full justify-between">
	<h6
		class="w-full cursor-pointer text-sm font-semibold text-blue-500"
		@click="toggle('isSignature')"
	>
		{{ __('Signature') }}
	</h6>
	<div class="inline-flex w-24 flex-nowrap justify-end">
		<button
			class="border-0 bg-transparent px-2 py-1"
			v-show="!isSignature"
			@click.prevent="toggle('isSignature')"
		>
			{{ __('Show more') }}
		</button>
		<button
			class="border-0 bg-transparent px-2 py-1"
			v-show="isSignature"
			@click.prevent="toggle('isSignature')"
		>
			{{ __('Show less') }}
		</button>
	</div>
</div>

<x-section-border />

<x-splade-transition
	show="isSignature"
	enter="transition-opacity duration-75"
	enter-from="opacity-0"
	enter-to="opacity-100"
	leave="transition-opacity duration-150"
	leave-from="opacity-100"
	leave-to="opacity-0"
>
	<a
		href="https://www.signwell.com/online-signature/draw/"
		target="_blank"
	>
		{{ __('Signature') }}
	</a>
</x-splade-transition>
