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
        Schema::create('document_sequences', function (Blueprint $table) {
            $table->id();
            $table->string('document_code');
            $table->string('prefix')->nullable();
            $table->string('delimiter')->default('-');
            $table->unsignedBigInteger('sequence_number')->default(0);
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
        Schema::dropIfExists('document_sequences');
    }
};
