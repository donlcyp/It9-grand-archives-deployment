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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Links to users table
            $table->timestamp('issued_at')->nullable(); // When membership was issued
            $table->timestamps();
        });

        // Update users table to reference memberships
        if (Schema::hasColumn('users', 'membership_id')) {
            // Drop the existing string membership_id column if it exists
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('membership_id');
            });
        }
        if (!Schema::hasColumn('users', 'membership_id')) {
            Schema::table('users', function (Blueprint $table) {
                // Add foreign key to memberships table
                $table->foreignId('membership_id')->nullable()->constrained('memberships')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse changes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['membership_id']);
            $table->dropColumn('membership_id');
            $table->string('membership_id')->nullable(); // Restore original string column
        });

        // Drop memberships table
        Schema::dropIfExists('memberships');
    }
};