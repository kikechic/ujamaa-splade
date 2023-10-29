@seoTitle(__('Office'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('Office') }}
			</x-slot:title>
			<x-slot:content>
				<x-line-item>
					<x-slot:label>
						{{ __('Name') }}
					</x-slot:label>
					{{ $office->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Code') }}
					</x-slot:label>
					{{ $office->code }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Status') }}
					</x-slot:label>
					<x-status :active="$office->status" />
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Created By') }}
					</x-slot:label>
					{{ $office->user->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Updated By') }}
					</x-slot:label>
					{{ $office->updater->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Created At') }}
					</x-slot:label>
					{{ fusion_date_format($office->created_at, config('fusion.timestamp_format')) }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Updated At') }}
					</x-slot:label>
					{{ fusion_date_format($office->updated_at, config('fusion.timestamp_format')) }}
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
