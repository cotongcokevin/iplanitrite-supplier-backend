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
        Schema::create('supplier_role', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->boolean('immutable')->default(false);

            $table->uuid('supplier_id')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('supplier_permission', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');

            $table->uuid('supplier_role_id')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('supplier_role_id')->references('id')->on('supplier_role');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_permission');
        Schema::dropIfExists('supplier_role');
    }
};
