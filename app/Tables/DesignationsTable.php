<?php

namespace App\Tables;

use App\Models\Designation;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class DesignationsTable extends AbstractTable
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
        return Designation::query();
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
                columns: ['name']
            )
            ->column(
                key: 'name',
                searchable: true,
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'code',
                label: __('Code'),
                sortable: true,
            )
            ->column(
                key: 'status',
                label: __('Status'),
            )
            ->column(
                key: 'actions',
                label: __('Actions'),
                alignment: 'center',
                classes: 'w-16',
            )
            ->paginate(100);
    }
}
