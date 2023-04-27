<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->boolean('is_attach');
            $table->bigInteger('sent_by')->unsigned();
            $table->bigInteger('chat_id')->unsigned();
            $table->boolean('seen');
            $table->timestamps();
            $table->foreign('sent_by')->references('id')->on('users');
            $table->foreign('chat_id')->references('id')->on('chats');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
