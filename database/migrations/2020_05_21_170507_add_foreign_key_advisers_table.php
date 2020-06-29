<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyAdvisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advisers', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id')->after('id');
            $table->foreign('teacher_id')->references('id')->on('teachers');

            $table->unsignedBigInteger('student_id')->after('teacher_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedBigInteger('title_id')->after('student_id');
            $table->foreign('title_id')->references('id')->on('titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advisers', function (Blueprint $table) {
            //
        });
    }
}
