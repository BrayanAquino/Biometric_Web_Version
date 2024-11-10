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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->date('date_absence');
            $table->string('status_absence');
            $table->string('reason_absence')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('evidence_absences', function (Blueprint $table) {
            $table->id();
            $table->date('evidence_absence');
            $table->unsignedBigInteger('absence_id');  
            $table->foreign('absence_id')->references('id')->on('absences'); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence_absences');
        Schema::dropIfExists('absences');
    }
};
