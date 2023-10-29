<?php

namespace App\Tables;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class UsersTable extends AbstractTable
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
            ->with('roles');
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
                key: 'email',
                label: __('Email'),
                sortable: true,
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true,
            )
            ->column(
                key: 'actions',
                label: __('Actions'),
            )
            ->selectFilter(
                key: 'roles.id',
                label: __('Roles'),
                options: Role::pluck('name', 'id')->toArray(),
            );
    }
}
