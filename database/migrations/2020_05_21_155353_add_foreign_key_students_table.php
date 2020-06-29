<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('faculty_id')->after('user_id');
            $table->foreign('faculty_id')->references('id')->on('faculties');

            $table->unsignedBigInteger('department_id')->after('faculty_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedBigInteger('training_programs_id')->after('department_id');
            $table->foreign('training_programs_id')->references('id')->on('training_programs');

            $table->unsignedBigInteger('degree_id')->after('training_programs_id');
            $table->foreign('degree_id')->references('id')->on('degrees');

            $table->unsignedBigInteger('role_id')->after('year_of_admission');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
}
