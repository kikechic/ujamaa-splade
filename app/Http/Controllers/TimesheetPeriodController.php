<?php

namespace App\Http\Controllers;

use App\Enums\MonthsEnum;
use Illuminate\Http\Response;
use App\Models\TimesheetPeriod;
use Illuminate\Support\Facades\Gate;
use App\Tables\TimesheetPeriodsTable;
use ProtoneMedia\Splade\Facades\Toast;
use App\Enums\TimesheetPeriodStatusEnum;
use App\Services\TimesheetPeriodService;
use App\Http\Requests\StoreTimesheetPeriodRequest;
use App\Http\Requests\UpdateTimesheetPeriodRequest;

class TimesheetPeriodController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('timesheet_periods_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheet periods');

        return view('timesheet-periods.index', [
            'timesheetPeriods' => TimesheetPeriodsTable::class,
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('timesheet_periods_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheet periods');

        return view('timesheet-periods.create', [
            'months' => MonthsEnum::months(),
            'statuses' => TimesheetPeriodStatusEnum::statuses(),
        ]);
    }

    public function store(StoreTimesheetPeriodRequest $request, TimesheetPeriodService $timesheetPeriodService)
    {
        abort_unless(Gate::allows('timesheet_periods_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheet periods');

        $timesheetPeriod = $timesheetPeriodService->setValidated($request->validated())->create();

        Toast::title("Timesheet period {$timesheetPeriod->period_month?->name} $timesheetPeriod->period_year created successfully")->autoDismiss(3);

        return redirect()->route('timesheetPeriods.index');
    }

    public function show(TimesheetPeriod $timesheetPeriod)
    {
        abort_unless(Gate::allows('timesheet_periods_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheet periods');

        return view('timesheet-periods.show', [
            'timesheetPeriod' => $timesheetPeriod->load('user:id,name', 'updater:id,name')
        ]);
    }

    public function edit(TimesheetPeriod $timesheetPeriod)
    {
        abort_unless(Gate::allows('timesheet_periods_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheet periods');

        return view('timesheet-periods.edit', [
            'timesheetPeriod' => $timesheetPeriod,
            'months' => MonthsEnum::months(),
            'statuses' => TimesheetPeriodStatusEnum::statuses(),
        ]);
    }

    public function update(UpdateTimesheetPeriodRequest $request, TimesheetPeriod $timesheetPeriod, TimesheetPeriodService $timesheetPeriodService)
    {
        abort_unless(Gate::allows('timesheet_periods_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheet periods');

        $timesheetPeriodService->setTimesheetPeriod($timesheetPeriod)->setValidated($request->validated())->update();

        Toast::title("Timesheet period {$timesheetPeriod->period_month?->name} $timesheetPeriod->period_year updated successfully")->autoDismiss(3);

        return redirect()->route('timesheetPeriods.index');
    }

    public function destroy(TimesheetPeriod $timesheetPeriod, TimesheetPeriodService $timesheetPeriodService)
    {
        abort_unless(Gate::allows('timesheet_periods_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access timesheet periods');

        $timesheetPeriodService->setTimesheetPeriod($timesheetPeriod)->delete();

        Toast::title("Timesheet period {$timesheetPeriod->period_month?->name} $timesheetPeriod->period_year deleted successfully")->autoDismiss(3);

        return redirect()->route('timesheetPeriods.index');
    }
}
