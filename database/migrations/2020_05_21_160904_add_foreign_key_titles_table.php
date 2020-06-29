<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('titles', function (Blueprint $table) {
            $table->unsignedBigInteger('faculty_id')->after('name');
            $table->foreign('faculty_id')->references('id')->on('faculties');

            $table->unsignedBigInteger('department_id')->after('faculty_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedBigInteger('teacher_id')->after('department_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('titles', function (Blueprint $table) {
            //
        });
    }
}
