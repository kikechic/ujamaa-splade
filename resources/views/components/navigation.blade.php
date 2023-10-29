<div class="border-b-1 h-16 min-h-[4rem] w-full border-slate-200">
	<nav class="block h-full w-full py-2 print:hidden">
		<div class="flex flex-row justify-between">
			<div></div>
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
		</div>
	</nav>
</div>
