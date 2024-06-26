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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->date('date_of_birth');
            $table->date('last_donation_date');

            $table->foreignId("blood_type_id")->constrained("blood_types", 'id')->cascadeOnDelete();
            $table->foreignId("city_id")->constrained("cities", 'id')->noActionOnDelete();
            $table->foreignId('governorate_id')->constrained('governorates', 'id')->noActionOnDelete();

            $table->string('pin_code')->nullable();
            $table->dateTime('pin_code_expires_at')->nullable();

            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};