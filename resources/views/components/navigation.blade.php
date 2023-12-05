<div
	class="sticky top-0 h-16 min-h-[4rem] w-full justify-center border-slate-200 bg-slate-50 py-3 pt-4 shadow-md"
>
	<nav class="container px-4 mx-auto">
		<div class="flex flex-row justify-between">
			<div class="w-10 ml-10">
				<x-splade-link
					class=""
					href="#sidebar-modal"
				>
					<x-lucide-menu class="w-6 h-6" />
				</x-splade-link>
			</div>
			<div class="inline-flex items-center w-48 px-2">
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
		</div>
	</nav>
</div>
