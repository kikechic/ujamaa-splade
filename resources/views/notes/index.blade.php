@seoTitle(__('FAQ & Notes'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="full"
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('FAQ & Notes') }}
			</x-slot:title>
			<x-slot:content>
				<x-splade-toggle :data="[
				    'isAuthorisation' => true,
				    'isSignature' => true,
				]">
					@include('notes.partials.authorisation')
					@include('notes.partials.signature')
				</x-splade-toggle>
			</x-slot:content>
			<x-slot:footer>
				<x-splade-button
					@click="modal.close"
					:label="__('Close')"
				/>
			</x-slot:footer>
		</x-dialog-modal>
	</x-splade-modal>
</x-app-layout>
