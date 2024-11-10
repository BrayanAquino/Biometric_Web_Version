<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tardinesses', function (Blueprint $table) {
            $table->id();
            $table->date('date_tardiness');
            $table->time('entry_time');
            $table->string('status_tardiness');
            $table->string('reason_tardiness')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('evidence_tardinesses', function (Blueprint $table) {
            $table->id();
            $table->date('evidence_tardiness');
            $table->unsignedBigInteger('tardiness_id');
            $table->foreign('tardiness_id')->references('id')->on('absences');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence_tardinesses');
        Schema::dropIfExists('tardinesses');
    }
};
