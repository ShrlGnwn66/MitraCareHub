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
        Schema::create('mitra_care_hubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mitra');
            $table->text('description');
            $table->string('file');
            $table->boolean('status')->default(false);
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra_care_hubs');
    }
};