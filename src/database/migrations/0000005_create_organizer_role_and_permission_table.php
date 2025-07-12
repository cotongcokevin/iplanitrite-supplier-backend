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
        Schema::create('organizer_role', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->boolean('immutable')->default(false);

            $table->uuid('organizer_id')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('organizer_id')->references('id')->on('organizer');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('organizer_permission', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');

            $table->uuid('organizer_role_id')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('organizer_role_id')->references('id')->on('organizer_role');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizer_permission');
        Schema::dropIfExists('organizer_role');
    }
};
