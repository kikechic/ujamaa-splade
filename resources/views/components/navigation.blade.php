<div
	class="sticky top-0 h-16 min-h-[4rem] w-full justify-center border-slate-200 bg-slate-50 py-3 pt-4 shadow-md"
>
	<nav class="container mx-auto px-4">
		<div class="flex flex-row justify-between">
			<div class="ml-10 w-10">
				<x-splade-link
					class=""
					href="#sidebar-modal"
				>
					<x-lucide-menu class="h-6 w-6" />
				</x-splade-link>
			</div>
			<div class="inline-flex w-48 items-center px-2">
				<x-splade-state>
					<x-splade-form
						method="PUT"
						:action="route('companies.switch')"
						:default="['new_company' => auth()->user()->current_company_id]"
						submit-on-change="new_company"
					>
						<x-splade-select
							name="new_company"
							v-model="form.new_company"
						>
							<template v-for="company in state.shared.companies">
								<option :value="company.id">
									@{{ company.name }}
								</option>
							</template>
						</x-splade-select>
					</x-splade-form>
				</x-splade-state>
			</div>
			<div class="w-10">
				<Dropdown>
					<template #trigger>
						<button
							class="h-8 w-8 rounded-full bg-primary-500 text-base uppercase text-white"
							type="button"
						>
							{{ substr(auth()->user()->name, 0, 1) }}
						</button>
					</template>
					<div
						class="flex flex-col justify-start gap-3 whitespace-nowrap rounded-md bg-white p-3 shadow-md"
						role="menu"
					>
						<div
							class="px-2 py-2 uppercase hover:cursor-pointer hover:rounded-md hover:bg-gray-100"
						>
							{{ auth()->user()->name }}
						</div>
						<div
							class="px-2 py-2 uppercase hover:cursor-pointer hover:rounded-md hover:bg-gray-100"
						>
							<x-splade-link
								:href="route('logout')"
								method="POST"
								confirm
							>
								{{ __('Logout') }}
							</x-splade-link>
						</div>
					</div>
				</Dropdown>
			</div>
		</div>
	</nav>
</div>
