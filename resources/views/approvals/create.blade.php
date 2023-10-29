@seoTitle(__('Create Approval'))
<x-app-layout>
	<x-splade-modal class="!p-0" close-explicitly position="top">
		<x-splade-form method="post" action="{{ route('approvals.store') }}">
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Create Approval') }}
				</x-slot:title>
				<x-slot:content>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Name') }}
						</x-slot:label>
						<x-splade-input name="name" />
					</x-form-line-item>
				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit />
					<x-splade-button type="button" @click="modal.close" :label="__('Back')" />
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>
