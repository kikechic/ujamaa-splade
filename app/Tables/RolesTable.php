<?php

namespace App\Tables;

use App\Models\Role;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class RolesTable extends AbstractTable
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
        return Role::query()
            ->with('user:id,name')
            ->with('updater:id,name')
            ->withCount('permissions')
            ->withCount('users');
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
                key: 'name',
                label: __('Name'),
                sortable: true,
            )
            ->column(
                key: 'permissions_count',
                label: __('Permissions'),
                sortable: true,
            )
            ->column(
                key: 'users_count',
                label: __('Users'),
                sortable: true,
            )
            ->column(
                key: 'user.name',
                label: __('Created By'),
                sortable: true,
            )
            ->column(
                key: 'updater.name',
                label: __('Updated By'),
                sortable: true,
            )
            ->column(
                key: 'actions',
                label: __('Actions'),
            )
            ->paginate(100);
    }
}
