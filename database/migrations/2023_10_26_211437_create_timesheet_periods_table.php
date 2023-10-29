<?php

use App\Models\User;
use App\Models\Company;
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
        Schema::create('timesheet_periods', function (Blueprint $table) {
            $table->id();
            $table->year('period_year');
            $table->tinyInteger('period_month');
            $table->string('status');
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
        Schema::dropIfExists('timesheet_periods');
    }
};
