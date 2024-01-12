<?php

namespace App\Http\Controllers;

use App\Actions\ReopenApprovedTimesheetAction;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast;

class ReopenApprovedTimesheetController extends Controller
{
    public function __invoke(Timesheet $timesheet, ReopenApprovedTimesheetAction $reopenApprovedTimesheetAction)
    {
        $reopenApprovedTimesheetAction->handle(timesheet: $timesheet);

        Toast::title("Timesheet {$timesheet->timesheet_number} reopened.")->autoDismiss(3);

        return Redirect::back();
    }
}
