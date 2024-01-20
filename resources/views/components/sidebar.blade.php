<div class="px-2 xl:px-8">
    <ul class="list-none">
        <li class="items-center">
            <x-sidebar-link :active="request()->routeIs('home')" :href="route('home')">
                <x-lucide-layout-dashboard class="w-4 h-4 mr-2" />
                {{ __('Dashboard') }}
            </x-sidebar-link>
        </li>
        @can('users_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('users.*')" :href="route('users.index')">
                    <x-lucide-users class="w-4 h-4 mr-2" />
                    {{ __('Users') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('roles_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('roles.*')" :href="route('roles.index')">
                    <x-lucide-chevron-right class="w-4 h-4 mr-2" />
                    {{ __('Roles') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('permissions_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('permissions.*')" :href="route('permissions.index')">
                    {{ __('Permissions') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('companies_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('companies.*')" :href="route('companies.index')">
                    {{ __('Companies') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('departments_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('departments.*')" :href="route('departments.index')">
                    {{ __('Departments') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('designations_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('designations.*')" :href="route('designations.index')">
                    {{ __('Designations') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('donors_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('donors.*')" :href="route('donors.index')">
                    {{ __('Donors') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('offices_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('offices.*')" :href="route('offices.index')">
                    <x-lucide-lamp-desk class="w-4 h-4 mr-2" />
                    {{ __('Offices') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('employees_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('employees.*')" :href="route('employees.index')">
                    {{ __('Employees') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('leaveTypes_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('leaveTypes.*')" :href="route('leaveTypes.index')">
                    <x-lucide-palmtree class="w-4 h-4 mr-2" />
                    {{ __('Leave Types') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('timesheet_periods_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('timesheetPeriods.*')" :href="route('timesheetPeriods.index')">
                    <x-lucide-calendar-range class="w-4 h-4 mr-2" />
                    {{ __('Timesheet Periods') }}
                </x-sidebar-link>
            </li>
        @endcan
        @can('timesheets_access')
            <li class="items-center">
                <x-sidebar-link :active="request()->routeIs('timesheets.*')" :href="route('timesheets.index')">
                    <x-lucide-calendar-clock class="w-4 h-4 mr-2" />
                    {{ __('Timesheets') }}
                </x-sidebar-link>
            </li>
        @endcan
        <li class="items-center">
            <x-sidebar-link :active="request()->routeIs('approvalRequests.*')" :href="route('approvalRequests.index')">
                {{ __('Requests To Approve') }}
            </x-sidebar-link>
        </li>
        <li class="items-center">
            <x-sidebar-link :active="request()->routeIs('approvals.*')" :href="route('approvals.index')">
                {{ __('Approvals Setup') }}
            </x-sidebar-link>
        </li>
        <!--li class="items-center">
    <x-sidebar-link
     :active="request()->routeIs('notes')"
     :href="route('notes')"
     modal
    >
     {{ __('FAQ / Notes') }}
    </x-sidebar-link>
   </-li-->
    </ul>
</div>
