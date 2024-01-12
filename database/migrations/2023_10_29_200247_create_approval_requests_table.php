<?php

use App\Models\User;
use App\Models\Company;
use App\Models\Timesheet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Timesheet::class);
            $table->string('status');
            $table->foreignIdFor(User::class, 'requester_id');
            $table->foreignIdFor(User::class, 'approver_id');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(User::class, 'updater_id')->nullable();
            $table->foreignIdFor(Company::class)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_requests');
    }
};
