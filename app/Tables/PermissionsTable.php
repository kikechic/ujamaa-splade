<?php

namespace App\Tables;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class PermissionsTable extends AbstractTable
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
        return Permission::query()
            ->withCount('roles')
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
            ->withGlobalSearch(columns: ['id'])
            ->column(
                key: 'id',
                sortable: true
            )
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true,
            )
            ->column(
                key: 'roles_count',
                label: __('Roles'),
                sortable: true,
            )
            ->column(
                key: 'users_count',
                label: __('Users'),
                sortable: true,
            )
            ->selectFilter(
                key: 'roles.id',
                label: __('Roles'),
                options: Role::pluck('name', 'id')->toArray()
            );
    }
}
