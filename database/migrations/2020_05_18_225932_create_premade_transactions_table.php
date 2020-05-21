<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremadeTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('premade_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('premade_box_id')->constrained()->onDelete('cascade');
            $table->foreignId('courier_id')->constrained();
            $table->text('card_content')->nullable();
            $table->string('receiver_name');
            $table->string('receiver_address');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('premade_transactions');
    }
}
