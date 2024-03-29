<?php

namespace App\Tables;

use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\TimesheetPeriod;
use App\Enums\TimesheetStatusEnum;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class TimesheetsTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Timesheet::query()
            ->when(Gate::denies('access_all_timesheets'), function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->with([
                'employee',
                'department',
                'office',
                'timesheetPeriod',
                'user:id,name',
                'updater:id,name',
            ])
            ->orderBy('created_at', 'desc');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(
                columns: [
                    'timesheet_number',
                    'employee.employee_number',
                    'employee.first_name',
                    'employee.last_name',
                    'employee.middle_name',
                ]
            )
            ->column(
                key: 'timesheet_number',
                searchable: true,
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'created_at',
                label: __('Document Date'),
                as: fn ($date, $row) => fusion_date_format($date),
            )
            ->column(
                key: 'employee',
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'employee.employee_number',
                label: 'Staff ID',
                searchable: true,
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'department.name',
                label: 'Department',
                searchable: true,
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'office.name',
                label: __('Office'),
                searchable: true,
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'timesheetPeriod',
                label: __('Timesheet Period'),
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'status',
                label: __('Status'),
            )
            ->column(
                key: 'user.name',
                label: __('Created By'),
                hidden: true,
            )
            ->column(
                key: 'updater.name',
                label: __('Updated By'),
                hidden: true,
            )
            ->column(
                key: 'created_at',
                label: __('Created At'),
                as: fn ($date, $row) => fusion_date_format($date, config('fusion.timestamp_format')),
                hidden: true,
            )
            ->column(
                key: 'updated_at',
                label: __('Updated At'),
                as: fn ($date, $row) => fusion_date_format($date, config('fusion.timestamp_format')),
                hidden: true,
            )
            ->column(
                key: 'actions',
                label: __('Actions'),
                alignment: 'center',
            )
            ->selectFilter(
                key: 'timesheetPeriod.id',
                label: __('Period'),
                options: TimesheetPeriod::query()->orderBy('period_year', 'desc')->orderBy('period_month', 'desc')->get()->pluck('display_name', 'id')->toArray(),
            )
            ->selectFilter(
                key: 'employee.id',
                label: __('Employee'),
                options: Employee::query()->get()->pluck('display_name', 'id')->toArray(),
            )
            ->selectFilter(
                key: 'department.id',
                label: __('Department'),
                options: Department::query()->get()->pluck('name', 'id')->toArray(),
            )
            ->selectFilter(
                key: 'status',
                label: __('Status'),
                options: TimesheetStatusEnum::statuses(),
            )
            ->searchInput(
                key: 'employee.first_name',
                label: __('First Name'),
            )
            ->searchInput(
                key: 'employee.last_name',
                label: __('Last Name'),
            )
            ->paginate(100);
    }
}
