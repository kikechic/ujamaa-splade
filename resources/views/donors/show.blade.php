@seoTitle(__('Donor'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('Donor') }}
			</x-slot:title>
			<x-slot:content>
				<x-line-item>
					<x-slot:label>
						{{ __('Name') }}
					</x-slot:label>
					{{ $donor->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Code') }}
					</x-slot:label>
					{{ $donor->code }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Start Date') }}
					</x-slot:label>
					{{ fusion_date_format($donor->start_date) }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('End Date') }}
					</x-slot:label>
					{{ fusion_date_format($donor->end_date) }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Status') }}
					</x-slot:label>
					<x-status :active="$donor->status" />
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Created By') }}
					</x-slot:label>
					{{ $donor->user->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Updated By') }}
					</x-slot:label>
					{{ $donor->updater->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Created At') }}
					</x-slot:label>
					{{ fusion_date_format($donor->created_at, config('fusion.timestamp_format')) }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Updated At') }}
					</x-slot:label>
					{{ fusion_date_format($donor->updated_at, config('fusion.timestamp_format')) }}
				</x-line-item>
			</x-slot:content>
			<x-slot:footer>
				<x-splade-button
					v-on:click="modal.close"
					:label="__('Close')"
				/>
			</x-slot:footer>
		</x-dialog-modal>
	</x-splade-modal>
</x-app-layout>
