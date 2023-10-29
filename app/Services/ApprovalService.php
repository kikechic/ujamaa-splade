<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ApprovalService
{
    protected array $validated;
    protected User $approvalUser;

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function setApprovalUser($user): self
    {
        $this->approvalUser = $user;
        return $this;
    }

    public function update()
    {
        DB::transaction(function () {
            $this->approvalUser->approval()->updateOrCreate(['approval_user_id' => $this->approvalUser->id], $this->validated);
        });
    }
}
