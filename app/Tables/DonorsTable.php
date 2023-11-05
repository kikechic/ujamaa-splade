<?php

namespace App\Tables;

use App\Models\Donor;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class DonorsTable extends AbstractTable
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
        return Donor::query()
            ->with([
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
            ->withGlobalSearch(columns: ['id'])
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
                key: 'start_date',
                label: __('Start Date'),
                sortable: true,
            )
            ->column(
                key: 'end_date',
                label: __('End Date'),
                sortable: true,
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
                classes: 'w-16',
            );
    }
}
