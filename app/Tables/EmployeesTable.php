<?php

namespace App\Tables;

use App\Models\Employee;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class EmployeesTable extends AbstractTable
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
        return Employee::query()->with([
            'designation:id,name',
            'department:id,name',
            'office:id,name',
            'user:id,name',
            'updater:id,name',
        ]);
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
                    'first_name',
                    'middle_name',
                    'last_name'
                ]
            )
            ->column(
                key: 'employee_number',
                label: 'Job ID',
                searchable: true,
                sortable: true,
                canBeHidden: false,
            )
            ->column(
                key: 'actions',
                label: 'Actions',
                canBeHidden: false,
                alignment: 'center',
            )
            ->column(
                key: 'first_name',
                searchable: true,
                sortable: true,
                canBeHidden: false,
            )
            ->column(
                key: 'middle_name',
                searchable: true,
                sortable: true,
                canBeHidden: false,
            )
            ->column(
                key: 'last_name',
                searchable: true,
                sortable: true,
                canBeHidden: false,
            )
            ->column(
                key: 'designation.name',
                label: 'Job Title',
                searchable: true,
                sortable: true,
                canBeHidden: true,
            )
            ->column(
                key: 'department.name',
                label: 'Department',
                searchable: true,
                sortable: true,
                canBeHidden: true,
            )
            ->column(
                key: 'office.name',
                label: 'Office',
                searchable: true,
                sortable: true,
                canBeHidden: true,
                hidden: true,
            )
            ->column(
                key: 'start_date',
                label: 'Hire Date',
                searchable: true,
                sortable: true,
                hidden: true,
                canBeHidden: false,
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true,
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
            ->selectFilter(
                key: 'status',
                label: __('Status'),
                options: [
                    1 => 'Active',
                    0 => 'Inactive'
                ],
            )
            ->paginate(100);
    }
}
