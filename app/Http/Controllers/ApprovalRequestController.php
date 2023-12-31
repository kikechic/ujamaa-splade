<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\ApprovalRequest;
use App\Tables\ApprovalRequestsTable;
use ProtoneMedia\Splade\Facades\Toast;
use App\Services\ApprovalRequestService;
use App\Http\Requests\StoreApprovalRequestRequest;
use App\Http\Requests\UpdateApprovalRequestRequest;

class ApprovalRequestController extends Controller
{
    public function index()
    {
        //
        return view('approval-requests.index', [
            'approvalRequests' => ApprovalRequestsTable::class,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreApprovalRequestRequest $request, ApprovalRequestService $approvalRequestService)
    {
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

        $approvalRequestService->setValidated($request->validated())->create();

        Toast::title("Approval request sent successfully")->autoDismiss(3);

        return back();
    }

    public function show(ApprovalRequest $approvalRequest)
    {
        //
    }

    public function edit(ApprovalRequest $approvalRequest)
    {
        //
    }

    public function update(UpdateApprovalRequestRequest $request, ApprovalRequest $approvalRequest, ApprovalRequestService $approvalRequestService)
    {
        //
        $approvalRequestService->setApprovalRequest($approvalRequest)->setValidated($request->validated())->update();

        Toast::title("Request approved successfully")->autoDismiss(3);

        return redirect()->back();
    }

    public function destroy(ApprovalRequest $approvalRequest)
    {
        //
    }

    public function approve(UpdateApprovalRequestRequest $request, ApprovalRequestService $approvalRequestService)
    {
        //
        $approvalRequestService->setValidated($request->validated())->approve();

        Toast::title("Request approved successfully")->autoDismiss(3);

        return redirect()->back();
    }

    public function reject(UpdateApprovalRequestRequest $request, ApprovalRequestService $approvalRequestService)
    {
        //
        $approvalRequestService->setValidated($request->validated())->reject();

        Toast::title("Request rejected successfully")->autoDismiss(3);

        return redirect()->back();
    }
}
