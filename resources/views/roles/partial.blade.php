<div class="grid grid-cols-1 gap-4">
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
			{{ __('Permissions') }}
		</x-slot:label>
		<x-splade-select
			name="permission_id"
			v-model="form.permission_id"
			:options="$permissions"
			multiple
			choices
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
