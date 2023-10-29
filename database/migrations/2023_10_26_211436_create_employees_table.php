<?php

use App\Models\User;
use App\Models\Office;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('start_date');
            $table->date('inactive_date')->nullable();
            $table->string('email')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignIdFor(Department::class);
            $table->foreignIdFor(Designation::class)->nullable();
            $table->foreignIdFor(Office::class)->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(User::class, 'updater_id')->nullable();
            $table->foreignIdFor(Company::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
