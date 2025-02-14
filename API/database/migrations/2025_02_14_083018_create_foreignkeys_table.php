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
        // Add foreign key to people table
        Schema::table('people', function (Blueprint $table) {
            $table->foreign('case_id')
                ->references('id')
                ->on('cases')
                ->onDelete('cascade');
        });

        // Add foreign key to witnesses table
        Schema::table('witnesses', function (Blueprint $table) {
            $table->foreign('case_id')
                ->references('id')
                ->on('cases')
                ->onDelete('cascade');
        });

        // Add foreign key to cases table for investigator
        Schema::table('cases', function (Blueprint $table) {
            $table->foreign('investigator_id')
                ->references('id')
                ->on('people')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
        });

        Schema::table('witnesses', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->dropForeign(['investigator_id']);
        });
    }
};
