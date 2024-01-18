<?php

namespace App\Actions\ApprovalRequest;

use App\Enums\TimesheetStatusEnum;
use App\Exceptions\FusionException;
use App\Models\ApprovalRequest;
use App\Models\Timesheet;
use App\Models\TimesheetApproval;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

final class StoreApprovalRequestAction
{
    protected Timesheet $timesheet;
    protected array $validated;

    public function handle(Timesheet $timesheet, array $validated = [])
    {
        $this->timesheet = $timesheet;
        $this->validated = $validated;

        $loggedInUser = auth()->user();

        $approval = $loggedInUser->approval;

        // if (!$approval->approval_user_id || !$approval->approver_id) {
        //     throw new FusionException(
        //         code: Response::HTTP_UNAUTHORIZED,
        //         message: "No approval workflow set for {$loggedInUser->name}"
        //     );
        // }

        DB::transaction(function () use ($loggedInUser) {

            $approverId = $loggedInUser->approval->approver_id ?? 1;

            ApprovalRequest::query()->create([
                'timesheet_id' => $this->timesheet->id,
                'status' => 'pending',
                'requester_id' => $loggedInUser->id,
                'approver_id' => $approverId,
            ]);

            $this->timesheet->update([
                'status' => TimesheetStatusEnum::Pending_Approval,
            ]);

            // TimesheetApproval::query()->updateOrCreate([
            //     'timesheet_id' => $this->timesheet->id,
            // ], [
            //     'approval_date' => $this->validated['approval_date'],
            // ]);

            session(['fusion' => ['approval_request_sent' => true]]);
        });
    }
}
