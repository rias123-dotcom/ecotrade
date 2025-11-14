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
        Schema::create('traders', function (Blueprint $table) {
            $table->id('traderID');
            $table->integer('creditScoreID')->nullable(); 
            $table->string('firstName', 100);
            $table->string('middleName', 100)->nullable();
            $table->string('lastName', 100);
            $table->string('address', 100);
            $table->string('city', 100); 
            $table->string('province', 100);
            $table->string('country', 100);
            $table->string('email')->unique();
            $table->string('contactNumber', 11);
            $table->string('password');
            $table->string('zipCode', 4); 
            $table->enum('docType', ['Drivers License', 'Passport', 'UMID/SSS/GSIS'])->nullable();
            $table->string('identityDoc', 255)->nullable();
            $table->string('faceVerified', 255)->nullable();
            $table->enum('role', ['admin', 'trader']);
            $table->enum('accountStatus', ['active', 'inactive'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
