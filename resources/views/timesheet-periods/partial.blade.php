<div class="grid grid-cols-1">
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Period Year') }}
		</x-slot:label>
		<x-splade-input
			name="period_year"
			v-model="form.period_year"
		/>
	</x-form-line-item>
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Period Month') }}
		</x-slot:label>
		<x-splade-select
			name="period_month"
			v-model="form.period_month"
			:options="$months"
		/>
	</x-form-line-item>
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Status') }}
		</x-slot:label>
		<x-splade-select
			name="status"
			v-model="form.status"
			:options="$statuses"
		/>
	</x-form-line-item>
	<x-splade-errors>
		<template v-if="errors.has('timesheet_period_exists')">
			<x-line-item>
				<x-slot:label>
					{{ __('Timesheet Period Check') }}
				</x-slot:label>
				<p
					class="font-semibold text-red-500"
					v-text="errors.first('timesheet_period_exists')"
				/>
			</x-line-item>
		</template>
	</x-splade-errors>
</div>
