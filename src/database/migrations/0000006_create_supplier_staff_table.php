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
        Schema::create('supplier_staff', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth')->nullable();

            $table->uuid('supplier_id');
            $table->uuid('supplier_role_id');
            $table->uuid('contact_number_id')->nullable();
            $table->uuid('address_id')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->foreign('supplier_role_id')->references('id')->on('supplier_role');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('supplier_staff', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('supplier_staff');
            $table->foreign('updated_by')->references('id')->on('supplier_staff');
        });

        DB::statement('
            CREATE UNIQUE INDEX unique_email_not_deleted
            ON supplier_staff (email)
            WHERE deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_staff');
    }
};
