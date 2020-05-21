<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremadeBoxesTable extends Migration
{
    public function up()
    {
        Schema::create('premade_boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('premade_box_category_id')->constrained();
            $table->string('name');
            $table->string('type');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('premade_boxes');
    }
}
