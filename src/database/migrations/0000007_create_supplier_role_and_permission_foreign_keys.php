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
        Schema::table('supplier_role', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('supplier_staff');
            $table->foreign('updated_by')->references('id')->on('supplier_staff');
        });

        Schema::table('supplier_permission', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('supplier_staff');
            $table->foreign('updated_by')->references('id')->on('supplier_staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier_role', function (Blueprint $table) {
            $table->dropForeign('supplier_role_created_by_foreign');
            $table->dropForeign('supplier_role_updated_by_foreign');
        });

        Schema::table('supplier_permission', function (Blueprint $table) {
            $table->dropForeign('supplier_permission_created_by_foreign');
            $table->dropForeign('supplier_permission_updated_by_foreign');
        });
    }
};
