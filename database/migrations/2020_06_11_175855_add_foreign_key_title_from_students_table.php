<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyTitleFromStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('title_from_students', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->after('id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedBigInteger('teacher_id')->after('student_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('title_from_students', function (Blueprint $table) {
            //
        });
    }
}
