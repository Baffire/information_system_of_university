<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitleConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_confirms', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('confirmation')->nullable();
            $table->tinyInteger('negative')->nullable();
            $table->timestamp('date_control')->nullable();
            $table->string('order', 100)->nullable();
            $table->string('reorder', 100)->nullable();
            $table->string('estimate', 20)->nullable();
            $table->timestamp('date_thesis_defense')->nullable();
            $table->string('order_thesis_defense')->nullable();
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
        Schema::dropIfExists('title_confirms');
    }
}
