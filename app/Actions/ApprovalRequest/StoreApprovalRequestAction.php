<?php

namespace App\Actions\ApprovalRequest;

use App\Enums\TimesheetStatusEnum;
use App\Exceptions\FusionException;
use App\Models\ApprovalRequest;
use App\Models\Timesheet;
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

        $this->timesheet->load('user');

        $userWhoCreatedTimesheet = $this->timesheet->user;

        $approval = $userWhoCreatedTimesheet->approval;

        if (!$approval->approval_user_id || !$approval->approver_id) {
            throw new FusionException(
                code: Response::HTTP_UNAUTHORIZED,
                message: "No approval workflow set for {$userWhoCreatedTimesheet->name}"
            );
        }

        DB::transaction(function () use ($userWhoCreatedTimesheet) {

            $approverId = $userWhoCreatedTimesheet->approval->approver_id;

            ApprovalRequest::query()->create([
                'timesheet_id' => $this->timesheet->id,
                'status' => 'pending',
                'requester_id' => $userWhoCreatedTimesheet->id,
                'approver_id' => $approverId,
            ]);

            $this->timesheet->update([
                'status' => TimesheetStatusEnum::Pending_Approval,
            ]);

            session(['fusion' => ['approval_request_sent' => true]]);
        });
    }
}
