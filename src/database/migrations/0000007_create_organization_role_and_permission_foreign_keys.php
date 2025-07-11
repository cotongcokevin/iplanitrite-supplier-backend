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
        Schema::table('organizer_role', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('organizer_staff');
            $table->foreign('updated_by')->references('id')->on('organizer_staff');
        });

        Schema::table('organizer_permission', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('organizer_staff');
            $table->foreign('updated_by')->references('id')->on('organizer_staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizer_role', function (Blueprint $table) {
            $table->dropForeign('organizer_role_created_by_foreign');
            $table->dropForeign('organizer_role_updated_by_foreign');
        });

        Schema::table('organizer_permission', function (Blueprint $table) {
            $table->dropForeign('organizer_permission_created_by_foreign');
            $table->dropForeign('organizer_permission_updated_by_foreign');
        });
    }
};
