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
        Schema::create('schedules', function (Blueprint $table) {
            // $table->id();
            $table->date('date_scheduled');
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('for_group_id');
            $table->unsignedBigInteger('team_id');


            $table->foreign('entity_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('for_group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->timestamps();
            $table->primary(array('date_scheduled', 'entity_id', 'for_group_id', 'team_id'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
