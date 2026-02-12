<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add foreign key constraints to pivot tables.
     */
    public function up(): void
    {
        // Add FKs to permission_role
        if (Schema::hasTable('permission_role') && Schema::hasTable('permissions') && Schema::hasTable('roles')) {
            Schema::table('permission_role', function (Blueprint $table) {
                try {
                    $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
                    $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                } catch (\Exception $e) {
                    // FKs might already exist
                }
            });
        }

        // Add FKs to role_user
        if (Schema::hasTable('role_user') && Schema::hasTable('roles') && Schema::hasTable('users')) {
            Schema::table('role_user', function (Blueprint $table) {
                try {
                    $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                } catch (\Exception $e) {
                    // FKs might already exist
                }
            });
        }
    }

    public function down(): void
    {
        // Drop FKs from permission_role
        if (Schema::hasTable('permission_role')) {
            Schema::table('permission_role', function (Blueprint $table) {
                try {
                    $table->dropForeign('permission_role_permission_id_foreign');
                    $table->dropForeign('permission_role_role_id_foreign');
                } catch (\Exception $e) {
                    // FKs don't exist
                }
            });
        }

        // Drop FKs from role_user
        if (Schema::hasTable('role_user')) {
            Schema::table('role_user', function (Blueprint $table) {
                try {
                    $table->dropForeign('role_user_role_id_foreign');
                    $table->dropForeign('role_user_user_id_foreign');
                } catch (\Exception $e) {
                    // FKs don't exist
                }
            });
        }
    }
};
