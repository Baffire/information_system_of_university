<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('faculty_id')->after('finish_date');
            $table->foreign('faculty_id')->references('id')->on('faculties');

            $table->unsignedBigInteger('department_id')->after('faculty_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedBigInteger('training_program_id')->after('students')->nullable();
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
        Schema::table('notifications', function (Blueprint $table) {
            //
        });
    }
}
