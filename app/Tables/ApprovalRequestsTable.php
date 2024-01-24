<?php

namespace App\Tables;

use Illuminate\Http\Request;
use App\Models\ApprovalRequest;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class ApprovalRequestsTable extends AbstractTable
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
        return ApprovalRequest::query()
            ->where('approver_id', auth()->id())
            ->where('status', 'pending')
            ->with(['timesheet' => [
                'employee'
            ]
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
                    'id'
                ]
            )
            ->column(
                key: 'timesheet_id',
                label: __('Document Number'),
            )
            ->column(
                key: 'employee.employee_number',
                label: 'Staff ID',
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'employee.full_name',
                label: 'Employee Name',
                sortable: true,
                canBeHidden: false,
            )
            ->paginate(100);
    }
}
