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
        Schema::create('celebrant', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth')->nullable();

            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('client');

            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('client');

            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('client');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celebrant');
    }
};
