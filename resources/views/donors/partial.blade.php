<div class="grid grid-cols-1 gap-4">
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Code') }}
		</x-slot:label>
		<x-splade-input
			name="code"
			v-model="form.code"
		/>
	</x-form-line-item>
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Name') }}
		</x-slot:label>
		<x-splade-input
			name="name"
			v-model="form.name"
		/>
	</x-form-line-item>
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Start Date') }}
		</x-slot:label>
		<x-splade-input
			name="start_date"
			v-model="form.start_date"
			date
		/>
	</x-form-line-item>
	<x-form-line-item>
		<x-slot:label>
			{{ __('End Date') }}
		</x-slot:label>
		<x-splade-input
			name="end_date"
			v-model="form.end_date"
			date
		/>
	</x-form-line-item>
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Status') }}
		</x-slot:label>
		<x-splade-select
			name="status"
			v-model="form.status"
			:options="[1 => 'Active', 0 => 'Inactive']"
		/>
	</x-form-line-item>
</div>
