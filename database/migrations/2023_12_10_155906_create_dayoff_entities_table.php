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
        Schema::create('dayoff_entities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('added_by_user_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->date('date_booked');

            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dayoff_entities');
    }
};
