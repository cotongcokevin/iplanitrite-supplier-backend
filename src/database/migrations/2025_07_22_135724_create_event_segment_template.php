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
        Schema::create('event_segment_template', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('event_type');
            $table->string('template_name');
            $table->boolean('is_immutable');
            $table->boolean('is_rsvp');
            $table->boolean('on_field');

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->string('default_location_label')->nullable();
            $table->string('default_address_label')->nullable();
            $table->string('default_notes_label')->nullable();
            $table->string('default_date_from_label')->nullable();
            $table->string('default_date_to_label')->nullable();

            $table->jsonb('udf')->nullable();

            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('admin');

            $table->uuid('updated_by');
            $table->foreign('updated_by')->references('id')->on('admin');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_segment_template_custom_field');
        Schema::dropIfExists('event_segment_template');
    }
};
