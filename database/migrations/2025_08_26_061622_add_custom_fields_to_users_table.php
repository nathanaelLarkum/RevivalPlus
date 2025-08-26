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
        Schema::table('users', function (Blueprint $table) {
            // Add our custom columns after the 'password' column for organization.
            $table->string('phone_number')->nullable()->after('password');
            $table->decimal('last_known_latitude', 10, 7)->nullable()->after('phone_number');
            $table->decimal('last_known_longitude', 10, 7)->nullable()->after('last_known_latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop columns in reverse order of creation.
            $table->dropColumn(['phone_number', 'last_known_latitude', 'last_known_longitude']);
        });
    }
};
