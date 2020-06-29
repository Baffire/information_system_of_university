<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyRoadmapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roadmaps', function (Blueprint $table) {
            $table->unsignedBigInteger('degree_id')->after('id');
            $table->foreign('degree_id')->references('id')->on('degrees');

            $table->unsignedBigInteger('training_program_id')->after('degree_id');
            $table->foreign('training_program_id')->references('id')->on('training_programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roadmaps', function (Blueprint $table) {
            //
        });
    }
}
