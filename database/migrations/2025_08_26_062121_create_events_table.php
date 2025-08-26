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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Foreign key to the churches table. If a church is deleted, its events are also deleted.
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();

            // Foreign key to the event_types table.
            // If an event type is deleted, set this to null.
            $table->foreignId('event_type_id')->nullable()->constrained()->nullOnDelete();

            // Sunday=0, Monday=1, ..., Saturday=6
            $table->unsignedTinyInteger('day_of_week');

            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
