<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('recipient_id');
            $table->text('body_encrypted'); // encrypted text
            $table->boolean('read')->default(false);
            $table->string('conversation_key')->nullable(); // optional conversation id
            $table->timestamps();

            $table->index(['sender_id']);
            $table->index(['recipient_id']);
            $table->index(['conversation_key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
