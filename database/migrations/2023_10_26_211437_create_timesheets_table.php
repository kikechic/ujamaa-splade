<?php

use App\Models\User;
use App\Models\Office;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use App\Models\TimesheetPeriod;
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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->string('timesheet_number');
            $table->date('submission_date');
            $table->string('status');
            $table->foreignIdFor(TimesheetPeriod::class);
            $table->foreignIdFor(Employee::class);
            $table->foreignIdFor(Department::class)->nullable();
            $table->foreignIdFor(Designation::class)->nullable();
            $table->foreignIdFor(Office::class)->nullable();
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
        Schema::dropIfExists('timesheets');
    }
};
