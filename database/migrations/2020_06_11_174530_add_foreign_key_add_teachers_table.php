<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyAddTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('add_teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('title_confirm_id')->after('id');
            $table->foreign('title_confirm_id')->references('id')->on('title_confirms');

            $table->unsignedBigInteger('teacher_id')->after('title_confirm_id');
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
        Schema::table('add_teachers', function (Blueprint $table) {
            //
        });
    }
}
