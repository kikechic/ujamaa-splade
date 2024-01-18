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
        // Check if approver has been set and allow request only if approver is set.
        $approval = auth()->user()->approval;

        if (!$approval->approval_user_id) {
            Toast::warning("No approval workflow set for " . auth()->user()->name)->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        if (!$approval->approver_id) {
            Toast::warning("An approver for " . auth()->user()->name . " is not specified")->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        $approvalRequestService->setTimesheet($timesheet)->create();

        Toast::title("Approval request sent.")->autoDismiss(3);

        return Redirect::route('approvalRequests.index');
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
        // Check if approver has been set and allow request only if approver is set.
        $approval = auth()->user()->approval;

        if (!$approval->approval_user_id) {
            Toast::warning("No approval workflow set for " . auth()->user()->name)->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        if (!$approval->approver_id) {
            Toast::warning("An approver for " . auth()->user()->name . " is not specified")->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        if (auth()->id() == $approval->approver_id) {
            Toast::warning("You cannot approve your own timesheet")->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        $approvalRequestService->setTimesheet($timesheet)->update();

        Toast::title("Request approved.")->autoDismiss(3);

        return Redirect::route('approvalRequests.index');
    }

    public function destroy(Timesheet $timesheet)
    {
        //
    }

    public function approve(UpdateApprovalRequestRequest $request, Timesheet $timesheet, ApprovalRequestService $approvalRequestService)
    {
        $approval = auth()->user()->approval;

        if (!$approval->approval_user_id) {
            Toast::warning("No approval workflow set for " . auth()->user()->name)->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        if (!$approval->approver_id) {
            Toast::warning("An approver for " . auth()->user()->name . " is not specified")->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        if (auth()->id() == $approval->approver_id) {
            Toast::warning("You cannot approve your own timesheet")->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        $approvalRequestService->setTimesheet($timesheet)->approve();

        Toast::title("Request approved.")->autoDismiss(3);

        return Redirect::route('approvalRequests.index');
    }

    public function reject(UpdateApprovalRequestRequest $request, Timesheet $timesheet, ApprovalRequestService $approvalRequestService)
    {
        $approval = auth()->user()->approval;

        if (!$approval->approval_user_id) {
            Toast::warning("No approval workflow set for " . auth()->user()->name)->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        if (!$approval->approver_id) {
            Toast::warning("An approver for " . auth()->user()->name . " is not specified")->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        if (auth()->id() == $approval->approver_id) {
            Toast::warning("You cannot approve your own timesheet")->autoDismiss(3);
            return Redirect::route('approvalRequests.index');
        }

        $approvalRequestService->setTimesheet($timesheet)->reject();

        Toast::title("Request rejected.")->autoDismiss(3);

        return Redirect::route('approvalRequests.index');
    }
}
