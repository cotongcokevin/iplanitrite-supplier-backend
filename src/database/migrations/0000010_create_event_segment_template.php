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

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->string('default_location_label')->nullable();
            $table->string('default_address_label')->nullable();
            $table->string('default_notes_label')->nullable();
            $table->string('default_date_from_label')->nullable();
            $table->string('default_date_to_label')->nullable();

            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('admin');

            $table->uuid('updated_by');
            $table->foreign('updated_by')->references('id')->on('admin');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_segment_template_custom_field', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('type');
            $table->boolean('required');

            $table->uuid('event_segment_id')->nullable();
            $table->foreign('event_segment_id')->references('id')->on('event_segment_template');

            $table->timestamps();
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
