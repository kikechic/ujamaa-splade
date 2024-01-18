<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\ApprovalRequest;
use App\Tables\ApprovalRequestsTable;
use ProtoneMedia\Splade\Facades\Toast;
use App\Services\ApprovalRequestService;
use App\Http\Requests\StoreApprovalRequestRequest;
use App\Http\Requests\UpdateApprovalRequestRequest;
use App\Models\Timesheet;
use Illuminate\Support\Facades\Redirect;

class ApprovalRequestController extends Controller
{
    public function index()
    {
        return view('approval-requests.index', [
            'approvalRequests' => ApprovalRequestsTable::class,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreApprovalRequestRequest $request, ApprovalRequestService $approvalRequestService, Timesheet $timesheet)
    {
        dd($timesheet->toArray());
        // Check if approver has been set and allow request only if approver is set.
        $approval = auth()->user()->approval;

        if (!$approval->approval_user_id) {
            Toast::warning("No approval workflow set for " . auth()->user()->name)->autoDismiss(3);
            return back();
        }

        if (!$approval->approver_id) {
            Toast::warning("An approver for " . auth()->user()->name . " is not specified")->autoDismiss(3);
            return back();
        }

        $approvalRequestService->setTimesheet($timesheet)->create();

        Toast::title("Approval request sent.")->autoDismiss(3);

        return back();
    }

    public function show(Timesheet $timesheet)
    {
        //
    }

    public function edit(Timesheet $timesheet)
    {
        //
    }

    public function update(UpdateApprovalRequestRequest $request, Timesheet $timesheet, ApprovalRequestService $approvalRequestService)
    {
        $approvalRequestService->setTimesheet($timesheet)->update();

        Toast::title("Request approved.")->autoDismiss(3);

        return Redirect::back();
    }

    public function destroy(Timesheet $timesheet)
    {
        //
    }

    public function approve(UpdateApprovalRequestRequest $request, Timesheet $timesheet, ApprovalRequestService $approvalRequestService)
    {
        //
        $approvalRequestService->setTimesheet($timesheet)->approve();

        Toast::title("Request approved.")->autoDismiss(3);

        return Redirect::back();
    }

    public function reject(UpdateApprovalRequestRequest $request, Timesheet $timesheet, ApprovalRequestService $approvalRequestService)
    {
        $approvalRequestService->setTimesheet($timesheet)->reject();

        Toast::title("Request rejected.")->autoDismiss(3);

        return Redirect::back();
    }
}
