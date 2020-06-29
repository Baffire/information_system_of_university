<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDegreeOfPreparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degree_of_preparations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('confirmation')->nullable();
            $table->tinyInteger('negative')->nullable();
            $table->tinyInteger('employee_confirm')->nullable();
            $table->tinyInteger('employee_negative')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('degree_of_preparations');
    }
}
