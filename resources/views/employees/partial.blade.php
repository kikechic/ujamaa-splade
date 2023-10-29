<div class="grid grid-cols-2 gap-4">
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Employee Number') }}
		</x-slot:label>
		<x-splade-input
			name="employee_number"
			v-model="form.employee_number"
		/>
	</x-form-line-item>
	<x-form-line-item required>
		<x-slot:label>
			{{ __('First Name') }}
		</x-slot:label>
		<x-splade-input
			name="first_name"
			v-model="form.first_name"
		/>
	</x-form-line-item>
	<x-form-line-item>
		<x-slot:label>
			{{ __('Middle Name') }}
		</x-slot:label>
		<x-splade-input
			name="middle_name"
			v-model="form.middle_name"
		/>
	</x-form-line-item>
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Last Name') }}
		</x-slot:label>
		<x-splade-input
			name="last_name"
			v-model="form.last_name"
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
			{{ __('Inactive Date') }}
		</x-slot:label>
		<x-splade-input
			name="inactive_date"
			v-model="form.inactive_date"
			date
		/>
	</x-form-line-item>
	<x-form-line-item required>
		<x-slot:label>
			{{ __('Department') }}
		</x-slot:label>
		<x-splade-select
			name="department_id"
			v-model="form.department_id"
			:options="$departments"
			choices
		/>
	</x-form-line-item>
	<x-form-line-item>
		<x-slot:label>
			{{ __('Designation') }}
		</x-slot:label>
		<x-splade-select
			name="designation_id"
			v-model="form.designation_id"
			:options="$designations"
			choices
		/>
	</x-form-line-item>
	<x-form-line-item>
		<x-slot:label>
			{{ __('Office') }}
		</x-slot:label>
		<x-splade-select
			name="office_id"
			v-model="form.office_id"
			:options="$offices"
			choices
		/>
	</x-form-line-item>
	<x-form-line-item>
		<x-slot:label>
			{{ __('Email') }}
		</x-slot:label>
		<x-splade-input
			name="email"
			v-model="form.email"
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
