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
        Schema::create('event', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('type');

            $table->uuid('participant_one');
            $table->foreign('participant_one')->references('id')->on('participant');

            $table->uuid('participant_two');
            $table->foreign('participant_two')->references('id')->on('participant');

            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('supplier');

            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('supplier');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_segment', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');

            $table->string('location_label');
            $table->string('location')->nullable();

            $table->string('address_label');
            $table->uuid('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('address');

            $table->string('notes_label');
            $table->string('notes')->nullable();

            $table->string('date_from_label');
            $table->dateTime('date_from')->nullable();

            $table->string('date_to_label');
            $table->dateTime('date_to')->nullable();

            $table->jsonb('udfs')->nullable();

            $table->uuid('event_segment_template_id');
            $table->foreign('event_segment_template_id')->references('id')->on('event_segment_template');

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('event');

            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('supplier');

            $table->uuid('updated_by');
            $table->foreign('updated_by')->references('id')->on('supplier');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_segment');
        Schema::dropIfExists('event_and_event_segment');
    }
};
