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
        Schema::create('participant', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth')->nullable();

            $table->uuid('contact_number_id')->nullable();
            $table->foreign('contact_number_id')->references('id')->on('contact_number');

            $table->uuid('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('address');

            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('supplier_staff');

            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('supplier_staff');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant');
    }
};
