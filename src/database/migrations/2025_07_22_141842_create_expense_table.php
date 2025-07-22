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
        Schema::create('event_supplier_expense', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->boolean('is_personal_expense');
            $table->decimal('cost', 10);
            $table->decimal('sell', 10);

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('event');

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('supplier_staff');

            $table->uuid('updated_by');
            $table->foreign('updated_by')->references('id')->on('supplier_staff');

            $table->timestamps();
        });

        Schema::create('event_client_expense', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->decimal('amount', 10);

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('event');

            $table->uuid('client_id');
            $table->foreign('client_id')->references('id')->on('client');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_client_expense');
        Schema::dropIfExists('event_supplier_expense');
    }
};
