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
        Schema::create('churches', function (Blueprint $table) {
            $table->id();

            // Foreign key to the denominations table.
            // If a denomination is deleted, set this to null.
            $table->foreignId('denomination_id')->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');

            // Precision 10, 7 decimal places is good for lat/lng.
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->string('phone_number')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('website_url')->nullable();
            $table->string('timezone'); // e.g., 'America/Los_Angeles'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('churches');
    }
};
