<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('type', ['Personal', 'Externa'])->nullable(false)->default('Personal');
            $table->dateTime('res_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('entry_date')->nullable(false);
            $table->dateTime('depature_date')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
