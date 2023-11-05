<x-section-border />

<div class="inline-flex w-full justify-between">
	<h6
		class="w-full cursor-pointer text-sm font-semibold text-blue-500"
		@click="toggle('isAuthorisation')"
	>
		{{ __('Access Control') }}
	</h6>
	<div class="inline-flex w-24 flex-nowrap justify-end">
		<button
			class="border-0 bg-transparent px-2 py-1"
			v-show="!isAuthorisation"
			@click.prevent="toggle('isAuthorisation')"
		>
			{{ __('Show more') }}
		</button>
		<button
			class="border-0 bg-transparent px-2 py-1"
			v-show="isAuthorisation"
			@click.prevent="toggle('isAuthorisation')"
		>
			{{ __('Show less') }}
		</button>
	</div>
</div>

<x-section-border />

<x-splade-transition
	show="isAuthorisation"
	enter="transition-opacity duration-75"
	enter-from="opacity-0"
	enter-to="opacity-100"
	leave="transition-opacity duration-150"
	leave-from="opacity-100"
	leave-to="opacity-0"
>
	<p>
		The access control approach used is
		<strong>
			role-based access control (RBAC)
		</strong>
		where users are grouped into roles, and permissions are assigned to roles
		rather than directly to individual users. This helps simplify access control
		and management.
	</p>
	<p>
		Permissions are assigned to a role, and a user assigned a role. A user can
		have multiple roles, in effect inheriting all the permissions attached to the
		roles.
	</p>
	<p>
		Users who have the same role will have the same access to menu items and
		functionalities within the system.
	</p>
</x-splade-transition>
