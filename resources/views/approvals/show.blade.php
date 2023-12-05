@seoTitle(__('Approval Setup'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="5xl"
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('Approval Setup') }}
			</x-slot:title>
			<x-slot:content>
				<x-line-item>
					<x-slot:label>{{ __('User Name') }}</x-slot:label>
					{{ $user->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>{{ __('Email') }}</x-slot:label>
					{{ $user->email }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>{{ __('Approver') }}</x-slot:label>
					{{ $user->approval->approver->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>{{ __('Substitute') }}</x-slot:label>
					{{ $user->approval->substitute->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>{{ __('Employee Account') }}</x-slot:label>
					@if ($user->approval->employee->id)
						<x-splade-link
							class="text-blue-500 underline hover:text-primary-500"
							modal
							:href="route('employees.show', $user->approval->employee)"
						>
							{{ $user->approval->employee->display_name }}
						</x-splade-link>
					@endif
				</x-line-item>
				<x-line-item>
					<x-slot name="label">
						{{ __('Created by') }}
					</x-slot>
					{{ $user->approval->user->name }}
				</x-line-item>
				<x-line-item>
					<x-slot name="label">
						{{ __('Updated by') }}
					</x-slot>
					{{ $user->approval->updater->name }}
				</x-line-item>
				<x-line-item>
					<x-slot name="label">
						{{ __('Created at') }}
					</x-slot>
					{{ fusion_date_format($user->approval->created_at, config('fusion.timestamp_format')) }}
				</x-line-item>
				<x-line-item>
					<x-slot name="label">
						{{ __('Updated at') }}
					</x-slot>
					{{ fusion_date_format($user->approval->updated_at, config('fusion.timestamp_format')) }}
				</x-line-item>
			</x-slot:content>
			<x-slot:footer>
				<x-splade-button @click.prevent="modal.close">
					{{ __('Close') }}
				</x-splade-button>
			</x-slot:footer>
		</x-dialog-modal>
	</x-splade-modal>
</x-app-layout>
