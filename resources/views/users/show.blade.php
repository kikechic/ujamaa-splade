@seoTitle(__('User'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="7xl"
	>
		<x-splade-toggle :data="[
		    'isGeneral' => true,
		    'isCommunication' => false,
		    'isAdministration' => false,
		    'isPersonal' => false,
		]">
			<x-dialog-modal>
				<x-slot:title>
					{{ __('User') }}
				</x-slot:title>
				<x-slot:content>
					<x-section-border />

					<div class="inline-flex w-full justify-between">
						<h6
							class="w-full cursor-pointer text-sm font-semibold text-blue-500"
							@click="toggle('isGeneral')"
						>
							{{ __('General') }}
						</h6>
						<div class="inline-flex w-24 flex-nowrap justify-end">
							<button
								class="border-0 bg-transparent px-2 py-1"
								v-show="!isGeneral"
								@click.prevent="toggle('isGeneral')"
							>
								{{ __('Show more') }}
							</button>
							<button
								class="border-0 bg-transparent px-2 py-1"
								v-show="isGeneral"
								@click.prevent="toggle('isGeneral')"
							>
								{{ __('Show less') }}
							</button>
						</div>
					</div>

					<x-section-border />

					<x-splade-transition
						show="isGeneral"
						enter="transition-opacity duration-75"
						enter-from="opacity-0"
						enter-to="opacity-100"
						leave="transition-opacity duration-150"
						leave-from="opacity-100"
						leave-to="opacity-0"
					>

						<div class="grid grid-cols-2 gap-4">
							<x-line-item>
								<x-slot name="label">
									{{ __('Name') }}
								</x-slot>
								{{ $user->name }}
							</x-line-item>
							<x-line-item>
								<x-slot name="label">
									{{ __('Email') }}
								</x-slot>
								{{ $user->email }}
							</x-line-item>

							<x-line-item>
								<x-slot name="label">
									{{ __('Status') }}
								</x-slot>
								<x-status :active="$user->status" />
							</x-line-item>

							<x-line-item>
								<x-slot name="label">
									{{ __('Signature') }}
								</x-slot>
								<img
									src="{{ $user->signature }}"
									width="150"
									height="100"
								/>
							</x-line-item>

							<x-line-item>
								<x-slot name="label">
									{{ __('Created at') }}
								</x-slot>
								{{ $user->created_at->format(config('fusion.timestamp_format')) }}
							</x-line-item>
							<x-line-item>
								<x-slot name="label">
									{{ __('Updated at') }}
								</x-slot>
								{{ $user->updated_at->format(config('fusion.timestamp_format')) }}
							</x-line-item>
						</div>
					</x-splade-transition>

					<x-section-border />

					<x-section-border />

					<div class="">
						<h6 class="text-sm font-semibold text-blue-500">{{ __('Roles') }}</h6>
					</div>

					<x-section-border />

					<div class="flex flex-wrap">
						@foreach ($user->roles as $role)
							<span class="badge-primary">
								{{ $role->name }}
							</span>
						@endforeach
					</div>
				</x-slot:content>
				<x-slot:footer>
					<x-splade-button
						type="button"
						@click="modal.close"
						:label="__('Close')"
					/>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-toggle>
	</x-splade-modal>
</x-app-layout>
