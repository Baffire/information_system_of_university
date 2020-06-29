<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyTitleConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('title_confirms', function (Blueprint $table) {
            $table->unsignedBigInteger('title_id')->after('id');
            $table->foreign('title_id')->references('id')->on('titles');

            $table->unsignedBigInteger('student_id')->after('title_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedBigInteger('teacher_id')->after('student_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');

            $table->unsignedBigInteger('department_id')->after('teacher_id');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('title_confirms', function (Blueprint $table) {
            //
        });
    }
}
