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
        Schema::create('organizer_staff', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth')->nullable();

            $table->uuid('organizer_id');
            $table->uuid('organizer_role_id');
            $table->uuid('contact_id')->nullable();
            $table->uuid('address_id')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('organizer_id')->references('id')->on('organizer');
            $table->foreign('organizer_role_id')->references('id')->on('organizer_role');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('organizer_staff', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('organizer_staff');
            $table->foreign('updated_by')->references('id')->on('organizer_staff');
        });

        DB::statement('
            CREATE UNIQUE INDEX unique_email_not_deleted
            ON organizer_staff (email)
            WHERE deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizer_staff');
    }
};
