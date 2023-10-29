@seoTitle(__('Approvals Setup'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Approvals Setup') }}
		</x-slot:header>
		<x-slot:actions>
		</x-slot:actions>
		<x-splade-table
			:for="$approvals"
			search-debounce="500"
		>
			<x-splade-cell name>
				<x-splade-link
					modal
					:href="route('approvals.show', $item)"
				>
					{{ $item->name }}
				</x-splade-link>
			</x-splade-cell>
			<x-splade-cell approval.claim_limit>
				{{ $item->approval->claim_limit ? number_format($item->approval->claim_limit, 2) : '' }}
			</x-splade-cell>
			<x-splade-cell approval.payment_voucher_limit>
				{{ $item->approval->payment_voucher_limit ? number_format($item->approval->payment_voucher_limit, 2) : '' }}
			</x-splade-cell>
			<x-splade-cell approval.imprest_request_limit>
				{{ $item->approval->imprest_request_limit ? number_format($item->approval->imprest_request_limit, 2) : '' }}
			</x-splade-cell>
			<x-splade-cell approval.imprest_surrender_limit>
				{{ $item->approval->imprest_surrender_limit ? number_format($item->approval->imprest_surrender_limit, 2) : '' }}
			</x-splade-cell>
			<x-splade-cell approval.travel_request_limit>
				{{ $item->approval->travel_request_limit ? number_format($item->approval->travel_request_limit, 2) : '' }}
			</x-splade-cell>
			<x-splade-cell approval.travel_surrender_limit>
				{{ $item->approval->travel_surrender_limit ? number_format($item->approval->travel_surrender_limit, 2) : '' }}
			</x-splade-cell>
			<x-splade-cell approval.purchase_request_limit>
				{{ $item->approval->purchase_request_limit ? number_format($item->approval->purchase_request_limit, 2) : '' }}
			</x-splade-cell>
			<x-splade-cell approval.receipt_surrender_limit>
				{{ $item->approval->receipt_surrender_limit ? number_format($item->approval->receipt_surrender_limit, 2) : '' }}
			</x-splade-cell>
			<x-splade-cell actions>
				<x-index-actions-dropdown>
					@can('approvals_update')
						<x-splade-link
							class="index-actions text-blue-600"
							modal
							:href="route('approvals.edit', $item)"
							v-close-popper="true"
						>
							<x-lucide-edit-3 class="h-4 w-4" />
							{{ __('Update') }}
						</x-splade-link>
					@endcan
					@can('approvals_delete')
						<x-splade-link
							class="index-actions text-red-500"
							stay
							confirm
							method="DELETE"
							confirm-text="This action cannot be reversed!"
							confirm-button="Yes, delete!"
							cancel-button="No, cancel"
							:href="route('approvals.destroy', $item)"
							v-close-popper="true"
						>
							<x-lucide-x class="h-4 w-4" />
							{{ __('Delete') }}
						</x-splade-link>
					@endcan
				</x-index-actions-dropdown>
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>
