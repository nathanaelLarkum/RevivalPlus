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
        Schema::create('amenity_church', function (Blueprint $table) {
            // This table connects amenities to churches.
            $table->foreignId('amenity_id')->constrained()->cascadeOnDelete();
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();

            // Set the primary key to be the combination of the two foreign keys.
            // This prevents a church from having the same amenity more than once.
            $table->primary(['amenity_id', 'church_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenity_church');
    }
};
