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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('destination');
            $table->string('client');
            $table->string('reason');
            $table->string('travel_mode')->default('1');
            $table->string('accommodation')->default('0');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->tinyInteger('status')->default(0);
            $table->date('trip_date')->nullable();
            $table->string('adm_verified')->default('0');
            $table->string('hod_agm_gm_approved')->default('0');
            $table->string('director_approved')->nullable();
            $table->string('ceo_approved')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
