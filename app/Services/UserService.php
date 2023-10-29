<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $validated;
    protected User $user;

    public function setUser($user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setValidated(array $validated): self
    {
        $this->validated = $validated;
        return $this;
    }

    public function create(): User
    {
        return DB::transaction(function () {
            $this->user = User::query()->create($this->validated);
            return $this->user;
        });
    }

    public function update()
    {
        DB::transaction(function () {
            $this->user->update($this->validated);
        });
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->user->delete();
        });
    }
}
