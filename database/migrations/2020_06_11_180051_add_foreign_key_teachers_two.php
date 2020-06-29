<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyTeachersTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_degree_id')->after('user_id')->nullable();
            $table->foreign('academic_degree_id')->references('id')->on('academic_degrees');

            $table->unsignedBigInteger('status_id')->after('academic_degree_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->unsignedBigInteger('post_id')->after('status_id');
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
}
