@seoTitle(__('Company'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('Company') }}
			</x-slot:title>
			<x-slot:content>
				<x-line-item>
					<x-slot:label>
						{{ __('Name') }}
					</x-slot:label>
					{{ $company->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Code') }}
					</x-slot:label>
					{{ $company->code }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Status') }}
					</x-slot:label>
					<x-status :active="$company->status" />
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Created By') }}
					</x-slot:label>
					{{ $company->user->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Updated By') }}
					</x-slot:label>
					{{ $company->updater->name }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Created At') }}
					</x-slot:label>
					{{ fusion_date_format($company->created_at, config('fusion.timestamp_format')) }}
				</x-line-item>
				<x-line-item>
					<x-slot:label>
						{{ __('Updated At') }}
					</x-slot:label>
					{{ fusion_date_format($company->updated_at, config('fusion.timestamp_format')) }}
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
