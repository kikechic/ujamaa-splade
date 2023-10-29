<?php

namespace App\Services;

use App\Models\Timesheet;
use App\Models\ApprovalRequest;
use App\Enums\TimesheetStatusEnum;
use Illuminate\Support\Facades\DB;

class ApprovalRequestService
{
    protected array $validated;
    protected ApprovalRequest $approvalRequest;

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
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
            $this->approvalRequest = ApprovalRequest::query()->create([
                'documentable_id' => $this->validated['documentable_id'],
                'documentable_code' => $this->validated['documentable_code'],
                'documentable_type' => (new Timesheet)->getMorphClass(),
                'status' => 'pending',
                'requester_id' => auth()->id(),
                'approver_id' => auth()->user()->approval->approval_user_id,
            ]);

            Timesheet::query()->where('id', $this->validated['documentable_id'])->update([
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

            Timesheet::query()->where('id', $this->validated['documentable_id'])->update([
                'status' => TimesheetStatusEnum::approved(),
            ]);
        });
    }

    public function delete()
    {
    }

    public function approve(): void
    {
        DB::transaction(function () {
            ApprovalRequest::query()
                ->where('documentable_id', $this->validated['documentable_id'])
                ->where('documentable_code', 'timesheet')
                ->where('approver_id', auth()->id())
                ->update([
                    'status' => 'approved'
                ]);

            Timesheet::query()
                ->where('id', $this->validated['documentable_id'])
                ->update([
                    'status' => TimesheetStatusEnum::approved(),
                ]);
        });
    }

    public function reject(): void
    {
        DB::transaction(function () {
            ApprovalRequest::query()
                ->where('documentable_id', $this->validated['documentable_id'])
                ->where('documentable_code', 'timesheet')
                ->where('approver_id', auth()->id())
                ->update([
                    'status' => 'rejected'
                ]);

            Timesheet::query()
                ->where('id', $this->validated['documentable_id'])
                ->update([
                    'status' => TimesheetStatusEnum::open(),
                ]);
        });
    }
}
