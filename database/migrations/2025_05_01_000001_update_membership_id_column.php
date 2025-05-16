<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateMembershipIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'membership_id')) {
            // Drop foreign key constraint if exists
            try {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropForeign(['membership_id']);
                });
            } catch (\Exception $e) {
                // Foreign key does not exist, ignore
            }
            // Drop existing membership_id column
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('membership_id');
            });
        }

        if (!Schema::hasColumn('users', 'membership_id')) {
            Schema::table('users', function (Blueprint $table) {
                // Add membership_id as string and unique
                $table->string('membership_id')->unique()->nullable()->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'membership_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('membership_id');
            });
        }

        if (!Schema::hasColumn('users', 'membership_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('membership_id')->nullable()->after('email');
            });
        }
    }
}
