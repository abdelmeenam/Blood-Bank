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
        Schema::create('donation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('patient_phone');
            $table->string('patient_age');
            $table->string('hospital_name');
            $table->string('hospital_address');
            $table->integer('bags_count');
            $table->text('notes');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);

            $table->foreignId("city_id")->constrained("cities", 'id')->nullOnDelete();
            $table->foreignId("blood_type_id")->constrained("blood_types", 'id')->nullOnDelete();
            $table->foreignId("client_id")->constrained("clients", 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_requests');
    }
};