@seoTitle(__('Role'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('Role') }}
			</x-slot:title>
			<x-slot:content>
				<x-line-item>
					<x-slot:label>
						{{ __('Name') }}
					</x-slot:label>
					{{ $role->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Permissions') }}
					</x-slot:label>
					@if ($role->permissions_count > 0)
						<x-splade-link
							class="text-blue-500 hover:underline"
							modal
							:href="route('permissions.index')"
						>
							{{ $role->permissions_count }}
							{{ str()->plural('permission', $role->permissions_count) }}
						</x-splade-link>
					@endif
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Users') }}
					</x-slot:label>
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Created By') }}
					</x-slot:label>
					{{ $role->user->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Updated By') }}
					</x-slot:label>
					{{ $role->updater->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Created At') }}
					</x-slot:label>
					{{ fusion_date_format($role->created_at, config('fusion.timestamp_format')) }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Updated At') }}
					</x-slot:label>
					{{ fusion_date_format($role->updated_at, config('fusion.timestamp_format')) }}
				</x-line-item>
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
