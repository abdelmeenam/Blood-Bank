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
        Schema::create('table_blood_type_client', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('blood_type_id')->constrained('blood_types')->cascadeOnDelete();
            $table->primary(['client_id', 'blood_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_blood_type_client');
    }
};