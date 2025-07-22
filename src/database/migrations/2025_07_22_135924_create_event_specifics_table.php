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
        Schema::create('event_specifics', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('event');

            $table->boolean('udf');

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('supplier_staff');

            $table->uuid('updated_by');
            $table->foreign('updated_by')->references('id')->on('supplier_staff');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_specifics');
    }
};
