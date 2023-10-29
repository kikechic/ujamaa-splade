@seoTitle(__('Create Employee'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="7xl"
	>
		<x-splade-form
			method="POST"
			:action="route('employees.store')"
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Create Employee') }}
				</x-slot:title>
				<x-slot:content>
					@include('employees.partial')
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
