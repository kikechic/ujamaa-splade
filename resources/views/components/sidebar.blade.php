<nav
	class="relative z-10 flex flex-wrap justify-between bg-white px-6 py-4 !text-sm shadow-xl md:fixed md:bottom-0 md:left-0 md:top-0 md:block md:w-64 md:flex-row md:flex-nowrap md:overflow-hidden md:overflow-y-auto"
>
	<div
		class="mx-auto flex w-full flex-wrap items-center justify-start px-0 md:min-h-full md:flex-col md:flex-nowrap md:items-stretch"
	>
		<x-splade-link
			class="mr-0 inline-block whitespace-nowrap p-4 px-0 text-left text-xl font-bold uppercase text-blueGray-700 md:block md:pb-2"
			:href="route('home')"
		>
			<x-company-logo />
		</x-splade-link>

		<!-- Divider -->
		<hr class="mb-6 md:min-w-full" />

		<ul class="flex list-none flex-col justify-start md:min-w-full md:flex-col">
			<li class="items-center">
				<x-splade-link
					:class="request()->routeIs('home')
					    ? 'sidebar-nav-active'
					    : 'sidebar-nav'"
					:href="route('home')"
				>
					<x-lucide-tv class="mr-2 h-4 w-4" />
					{{ __('Dashboard') }}
				</x-splade-link>
			</li>
			@can('users_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('users.*')"
						:href="route('users.index')"
					>
						{{ __('Users') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('roles_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('roles.*')"
						:href="route('roles.index')"
					>
						{{ __('Roles') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('permissions_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('permissions.*')"
						:href="route('permissions.index')"
					>
						{{ __('Permissions') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('companies_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('companies.*')"
						:href="route('companies.index')"
					>
						{{ __('Companies') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('departments_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('departments.*')"
						:href="route('departments.index')"
					>
						{{ __('Departments') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('designations_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('designations.*')"
						:href="route('designations.index')"
					>
						{{ __('Designations') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('donors_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('donors.*')"
						:href="route('donors.index')"
					>
						{{ __('Donors') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('offices_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('offices.*')"
						:href="route('offices.index')"
					>
						{{ __('Offices') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('employees_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('employees.*')"
						:href="route('employees.index')"
					>
						{{ __('Employees') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('leaveTypes_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('leaveTypes.*')"
						:href="route('leaveTypes.index')"
					>
						{{ __('Leave Types') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('timesheet_periods_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('timesheetPeriods.*')"
						:href="route('timesheetPeriods.index')"
					>
						{{ __('Timesheet Periods') }}
					</x-sidebar-link>
				</li>
			@endcan
			@can('timesheets_access')
				<li class="items-center">
					<x-sidebar-link
						:active="request()->routeIs('timesheets.*')"
						:href="route('timesheets.index')"
					>
						{{ __('Timesheets') }}
					</x-sidebar-link>
				</li>
			@endcan
			<li class="items-center">
				<x-sidebar-link
					:active="request()->routeIs('timesheetApprovals.*')"
					:href="route('timesheetApprovals.index')"
				>
					{{ __('Timesheet Approvals') }}
				</x-sidebar-link>
			</li>
			<li class="items-center">
				<x-sidebar-link
					:active="request()->routeIs('approvals.*')"
					:href="route('approvals.index')"
				>
					{{ __('Approvals Setup') }}
				</x-sidebar-link>
			</li>
		</ul>
	</div>
</nav>
