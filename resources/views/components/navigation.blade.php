<div class="sticky top-0 h-16 min-h-[4rem] w-full justify-center border-slate-200 bg-slate-50 py-3 pt-4 shadow-md">
	<nav class="container mx-auto px-4">
		<div class="flex flex-row justify-between">
			<div class="w-10 ">
				<x-splade-link class="block lg:hidden" href="#sidebar-modal">
					<x-lucide-menu class="h-6 w-6" />
				</x-splade-link>
			</div>
			<div class="inline-flex">
				<div class="inline-flex w-48 items-center hidden px-2">
					<x-splade-state>
						<x-splade-form method="PUT" :action="route('companies.switch')" :default="['new_company' => auth()->user()->current_company_id]" submit-on-change="new_company">
							<x-splade-select name="new_company" v-model="form.new_company">
								<template v-for="company in state.shared.companies">
									<option :value="company.id">
										@{{ company.name }}
									</option>
								</template>
							</x-splade-select>
						</x-splade-form>
					</x-splade-state>
				</div>

				<div class="mr-2 inline-flex w-32 items-center overflow-ellipsis whitespace-nowrap align-middle">
					<span>
						{{ auth()->user()->name }}
					</span>
				</div>

				<div class="inline-flex w-10 flex-row items-center">
					<x-splade-link class="inline-flex flex-row items-center" :href="route('logout')" method="POST" confirm confirm-text="Logout?">
						<x-lucide-log-out class="h-4 w-4" />
						<span class="ml-2 hidden md:block">
							{{ __('Logout') }}
						</span>
					</x-splade-link>
				</div>
			</div>
		</div>
	</nav>
</div>