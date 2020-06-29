<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyDegreeOfPreparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('degree_of_preparations', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->after('id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedBigInteger('roadmap_id')->after('student_id');
            $table->foreign('roadmap_id')->references('id')->on('roadmaps');

            $table->unsignedBigInteger('file_id')->after('roadmap_id');
            $table->foreign('file_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('degree_of_preparations', function (Blueprint $table) {
            //
        });
    }
}
