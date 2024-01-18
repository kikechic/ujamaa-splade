<x-app-layout>
	<div class="flex flex-wrap gap-4 px-10 py-10">
		<div class="w-72 rounded-lg bg-white px-14 py-14 shadow-xl">
			<h6 class="text-xl">
				{{ __('Request To Approve') }}
			</h6>
			<div class="mt-8 text-2xl">
				<x-splade-link class="w-full font-semibold text-blue-600 hover:underline" :href="route('approvalRequests.index')">
					{{ $requestsToApprove }}
				</x-splade-link>
			</div>
		</div>
		<div class="w-72 rounded-lg bg-white px-14 py-14 shadow-xl">
			<h6 class="text-xl">
				{{ __('Notifications') }}
			</h6>
			<div class="mt-8 text-2xl">
				<x-splade-link class="font-semibold text-slate-700 hover:underline" modal :href="route('notifications.index')">
					{{ $unreadNotifications }}
				</x-splade-link>
			</div>
		</div>
	</div>
</x-app-layout>