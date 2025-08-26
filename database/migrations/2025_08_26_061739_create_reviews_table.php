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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Foreign key to the users table. If a user is deleted, their reviews are also deleted.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Foreign key to the churches table. If a church is deleted, its reviews are also deleted.
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();

            $table->unsignedTinyInteger('rating'); // A number from 1-5.
            $table->string('title')->nullable();
            $table->text('body');
            $table->string('status')->default('pending'); // For moderation: 'pending', 'approved', 'rejected'.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
