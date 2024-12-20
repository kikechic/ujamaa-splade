<?php

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(User::class, 'updater_id')->nullable();
            $table->foreignIdFor(Company::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
