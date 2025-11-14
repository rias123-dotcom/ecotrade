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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName', 100);
            $table->string('middleName', 100)->nullable();
            $table->string('lastName', 100);
            $table->string('email')->unique();
            $table->string('contactNumber', 11);
            $table->string('address', 100);
            $table->string('city', 100);
            $table->string('country', 100);
            $table->string('password', 20);
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('governmentIDType', ['Drivers License', 'Passport', 'UMID/SSS/GSIS'])->nullable();
            $table->string('uploadGovernmentID', 255)->nullable();
            $table->string('profilePicture', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
