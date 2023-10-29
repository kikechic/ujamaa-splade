@seoTitle(__('Edit Role'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-splade-form
			method="PUT"
			:action="route('roles.update', $role)"
			:default="[
			    'name' => $role->name,
			    'permission_id' => $role->permissions->pluck('id')->toArray(),
			    'status' => $role->status,
			]"
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Edit Role') }}
				</x-slot:title>
				<x-slot:content>
					@include('roles.partial')
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
