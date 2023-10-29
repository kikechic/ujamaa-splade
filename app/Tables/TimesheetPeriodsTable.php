<?php

namespace App\Tables;

use App\Enums\MonthsEnum;
use Illuminate\Http\Request;
use App\Models\TimesheetPeriod;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use App\Enums\TimesheetPeriodStatusEnum;

class TimesheetPeriodsTable extends AbstractTable
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
        return TimesheetPeriod::query()
            ->with([
                'user:id,name',
                'updater:id,name',
            ])
            ->orderBy('period_year', 'desc')
            ->orderBy('period_month', 'desc');
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
                columns: ['period_year']
            )
            ->column(
                key: 'period_year',
                label: 'Year',
                searchable: true,
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'month_name',
                label: 'Month'
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true,
                canBeHidden: false
            )
            ->column(
                key: 'user.name',
                label: __('Created By'),
            )
            ->column(
                key: 'updater.name',
                label: __('Updated By'),
            )
            ->column(
                key: 'actions',
                label: __('Actions'),
            )
            ->selectFilter(
                key: 'period_year',
                label: __('Year'),
                options: TimesheetPeriod::query()->distinct()->pluck('period_year', 'period_year')->toArray(),
            )
            ->selectFilter(
                key: 'period_month',
                label: __('Month'),
                options: MonthsEnum::months(),
            )
            ->selectFilter(
                key: 'status',
                label: __('Status'),
                options: TimesheetPeriodStatusEnum::statuses(),
            )
            ->paginate(100);
    }
}
