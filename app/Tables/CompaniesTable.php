<?php

namespace App\Tables;

use App\Models\Company;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class CompaniesTable extends AbstractTable
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
        return Company::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $timezones = fusion_timezones();
        $table
            ->withGlobalSearch(
                columns: ['name']
            )
            ->column(
                key: 'name',
                label: __('Name'),
                searchable: true,
                sortable: true,
                canBeHidden: false,
            )
            ->column(
                key: 'timezone',
                label: __('Timezone'),
                as: fn ($tz, $line) => $timezones[$tz],
                sortable: true,
            )
            ->column(
                key: 'status',
                label: __('Status'),
            )
            ->column(
                key: 'actions',
                label: __('Actions'),
            )
            ->selectFilter(
                key: 'timezone',
                label: __('Timezone'),
                options: $timezones,
            )
            ->paginate(100);
    }
}
