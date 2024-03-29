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
        Schema::create('client_governorate', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('governorate_id')->constrained('governorates')->cascadeOnDelete();
            $table->primary(['client_id', 'governorate_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_governorate');
    }
};