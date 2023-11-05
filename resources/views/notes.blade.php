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
				<a
					href="https://www.signwell.com/online-signature/draw/"
					target="_blank"
				>
					{{ __('Signature') }}
				</a>
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
