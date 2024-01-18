@seoTitle(__('Create User'))
<x-app-layout>
	<x-splade-modal class="!p-0" position="top" max-width="7xl" close-explicitly>
		<x-splade-form method="POST" :action="route('users.store')">
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Create User') }}
				</x-slot:title>
				<x-slot:content>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Name') }}
						</x-slot:label>
						<x-splade-input name="name" />
					</x-form-line-item>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Email') }}
						</x-slot:label>
						<x-splade-input name="email" />
					</x-form-line-item>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Password') }}
						</x-slot:label>
						<x-splade-input name="password" type="password" />
					</x-form-line-item>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Confirm Password') }}
						</x-slot:label>
						<x-splade-input name="password_confirmation" type="password" />
					</x-form-line-item>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Status') }}
						</x-slot:label>
						<x-splade-select name="status" v-model="form.status" :options="[1 => 'Active', 0 => 'Inactive']" />
					</x-form-line-item>
				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit />
					<x-splade-button type="button" @click="modal.close" :label="__('Close')" />
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>