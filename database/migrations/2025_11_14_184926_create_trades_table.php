<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trader_id'); // reference to users table
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('category', ['Item', 'Service', 'Skill']);
            $table->string('quantity')->nullable();
            $table->string('seeking')->nullable();
            $table->decimal('value', 10, 2)->default(0);
            $table->string('location')->nullable();
            $table->string('status')->default('Active'); // Active, Ongoing, Completed, Pending Admin
            $table->string('image_url')->nullable();
            $table->boolean('is_user_post')->default(true);
            $table->integer('offers')->default(0);
            $table->timestamps();

            $table->foreign('trader_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
