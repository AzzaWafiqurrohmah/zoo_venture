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
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shed_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('scientific_name');
            $table->string('name');
            $table->text('image')->nullable();
            $table->string('origin');
            $table->string('description');
            $table->string('article');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
