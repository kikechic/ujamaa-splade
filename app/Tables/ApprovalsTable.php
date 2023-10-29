<?php

namespace App\Tables;

use App\Models\User;
use App\Models\Approval;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class ApprovalsTable extends AbstractTable
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
        return User::query()
            ->with([
                'approval' => [
                    'employee',
                    'approver',
                    'substitute',
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
            ->withGlobalSearch(columns: ['name'])
            ->column(
                key: 'id',
                label: __('Entry No'),
                sortable: true
            )
            ->column(
                key: 'name',
                label: __('Name')
            )
            ->column(
                key: 'approval.approver.name',
                label: __('Approver')
            )
            ->column(
                key: 'approval.substitute.name',
                label: __('Substitute')
            )
            ->column(
                key: 'approval.employee.full_name',
                label: __('Employee')
            )
            ->column(
                key: 'actions',
                label: __('Actions'),
                alignment: 'center',
                classes: 'w-16',
            )
            ->defaultSort('id')
            ->selectFilter(
                key: 'id',
                label: __('User'),
                options: User::query()->pluck('name', 'id')->toArray()
            )
            ->paginate(100);
    }
}
