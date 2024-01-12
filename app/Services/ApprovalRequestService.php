<?php

namespace App\Services;

use App\Models\Timesheet;
use Illuminate\Http\Response;
use App\Models\ApprovalRequest;
use App\Enums\TimesheetStatusEnum;
use Illuminate\Support\Facades\DB;

class ApprovalRequestService
{
    protected Timesheet $timesheet;
    protected ApprovalRequest $approvalRequest;

    public function setTimesheet(Timesheet $timesheet): self
    {
        $this->timesheet = $timesheet;
        return $this;
    }

    public function setApprovalRequest(ApprovalRequest $approvalRequest): self
    {
        $this->approvalRequest = $approvalRequest;
        return $this;
    }

    public function create(): ApprovalRequest
    {
        return DB::transaction(function () {
            $approverId = auth()->user()->approval->approver_id;

            $this->approvalRequest = ApprovalRequest::query()->create([
                'timesheet_id' => $this->timesheet->id,
                'status' => 'pending',
                'requester_id' => auth()->id(),
                'approver_id' => $approverId,
            ]);

            Timesheet::query()->where('id', $this->timesheet->id)->update([
                'status' => TimesheetStatusEnum::pending(),
            ]);

            return $this->approvalRequest;
        });
    }

    public function update(): void
    {
        DB::transaction(function () {
            $this->approvalRequest->update([
                'status' => 'approved',
            ]);

            Timesheet::query()->where('id', $this->approvalRequest->timesheet_id)->update([
                'status' => TimesheetStatusEnum::approved(),
            ]);
        });
    }

    public function delete(): void
    {
    }

    public function approve(): void
    {
        DB::transaction(function () {
            ApprovalRequest::query()
                ->where('timesheet_id', $this->timesheet->id)
                ->where('approver_id', auth()->id())
                ->update([
                    'status' => 'approved'
                ]);

            Timesheet::query()
                ->where('id', $this->timesheet->id)
                ->update([
                    'status' => TimesheetStatusEnum::approved(),
                ]);
        });
    }

    public function reject(): void
    {
        DB::transaction(function () {
            ApprovalRequest::query()
                ->where('timesheet_id', $this->timesheet->id)
                ->where('approver_id', auth()->id())
                ->update([
                    'status' => 'rejected'
                ]);

            Timesheet::query()
                ->where('id', $this->timesheet->id)
                ->update([
                    'status' => TimesheetStatusEnum::open(),
                ]);
        });
    }
}
