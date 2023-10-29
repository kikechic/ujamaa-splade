@seoTitle(__('Edit User'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		close-explicitly
		position="top"
		max-width="7xl"
	>
		<x-splade-form
			id="destroy-signature-form"
			method="POST"
			confirm
			:action="route('user-signature.destroy', $user)"
			stay
			@success="$splade.emit('signature-destroyed')"
		></x-splade-form>
		<x-splade-form
			method="PUT"
			:default="$user"
			:action="route('users.update', $user)"
			stay
			@success="$splade.emit('user-updated-' + {{ $user->id }})"
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Edit User') }}
				</x-slot:title>
				<x-slot:content>
					<x-form-line-item>
						<x-slot name="label">
							{{ __('Name') }}
						</x-slot>
						<x-splade-input name="name" />
					</x-form-line-item>

					<x-form-line-item>
						<x-slot name="label">
							{{ __('Email') }}
						</x-slot>
						<x-splade-input name="email" />
					</x-form-line-item>
					<x-splade-rehydrate on="signature-destroyed">
						<x-form-line-item>
							<x-slot name="label">
								{{ __('Signature') }}
							</x-slot>
							<x-splade-file
								name="signature"
								accept="image/png"
								max-size="5MB"
								filepond
								preview
							/>
						</x-form-line-item>
					</x-splade-rehydrate>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Remove Signature') }}
						</x-slot:label>
						<button
							class="btn btn-sm btn-danger"
							form="destroy-signature-form"
							type="submit"
						>
							{{ __('Remove signature') }}
						</button>
					</x-form-line-item>
					<x-form-line-item>
						<x-slot name="label">
							{{ __('Roles') }}
						</x-slot>
						<x-splade-select
							name="roles[]"
							:options="$roles"
							placeholder="Select roles..."
							multiple
							relation
							choices
						/>
					</x-form-line-item>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Status') }}
						</x-slot:label>
						<x-splade-select
							name="status"
							v-model="form.status"
							:options="[1 => 'Active', 0 => 'Inactive']"
						/>
					</x-form-line-item>
				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit />
					<x-splade-button
						type="button"
						@click="modal.close"
						:label="__('Back')"
					/>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>
