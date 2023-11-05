@seoTitle(__('Notifications'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		max-width="7xl"
		close-explicitly
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('Unread Notifications') }}
			</x-slot:title>
			<x-slot:content>
				@forelse($notifications as $notification)
					<div
						class="alert alert-success"
						role="alert"
					>
						[{{ $notification->created_at }}] User {{ $notification->data['name'] }}
						({{ $notification->data['email'] }})
						has just registered.
						<a
							class="mark-as-read float-right"
							data-id="{{ $notification->id }}"
							href="#"
						>
							{{ __('Mark as read') }}
						</a>
					</div>

					@if ($loop->last)
						<a
							id="mark-all"
							href="#"
						>
							{{ __('Mark all as read') }}
						</a>
					@endif
				@empty
					{{ __('There are no new notifications') }}
				@endforelse
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
