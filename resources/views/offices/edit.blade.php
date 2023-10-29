@seoTitle(__('Edit Office'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-splade-form
			method="PUT"
			:action="route('offices.update', $office)"
			:default="$office"
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Edit Office') }}
				</x-slot:title>
				<x-slot:content>
					@include('offices.partial')
				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit />
					<x-splade-button
						type="button"
						v-on:click="modal.close"
						:label="__('Close')"
					/>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>
