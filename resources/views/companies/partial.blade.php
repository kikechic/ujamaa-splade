<div class="grid grid-cols-1 gap-4">
	<div>
		<x-form-line-item>
			<x-slot:label>
				{{ __('Company Name') }}
			</x-slot:label>
			<x-splade-input name="name" />
		</x-form-line-item>
		<x-form-line-item>
			<x-slot:label>
				{{ __('Company Logo') }}
			</x-slot:label>
			<x-splade-file name="logo" accept="image/png" max-size="5MB" filepond preview credits="false" />
		</x-form-line-item>
		<x-form-line-item>
			<x-slot:label>
				{{ __('Timezone') }}
			</x-slot:label>
			<x-splade-select name="timezone" :options="$timezones" choices />
		</x-form-line-item>
		<x-form-line-item>
			<x-slot:label>
				{{ __('Status') }}
			</x-slot:label>
			<x-splade-select name="status" :options="[1 => 'Active', 0 => 'Inactive']" />
		</x-form-line-item>
	</div>
</div>