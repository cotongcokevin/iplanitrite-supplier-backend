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
            $table->string('status');
            $table->string('name');
            $table->string('type');

            $table->uuid('client_id');
            $table->foreign('client_id')->references('id')->on('client');

            $table->uuid('celebrant_one');
            $table->foreign('celebrant_one')->references('id')->on('celebrant');

            $table->uuid('celebrant_two');
            $table->foreign('celebrant_two')->references('id')->on('celebrant');

            $table->unique(['celebrant_one', 'celebrant_two']);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_supplier', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('status');
            $table->text('reason_for_cancellation')->nullable();

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('event');

            $table->unique(['supplier_id', 'event_id']);
            $table->timestamps();
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

            $table->jsonb('custom_fields')->nullable();

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

        Schema::create('event_segment_staff', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->uuid('supplier_staff_id');
            $table->foreign('supplier_staff_id')->references('id')->on('supplier_staff');

            $table->uuid('event_segment_id');
            $table->foreign('event_segment_id')->references('id')->on('event_segment');

            $table->timestamps();
        });

        Schema::create('event_supplier_collab', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('status');

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->uuid('supplier_partner_id');
            $table->foreign('supplier_partner_id')->references('id')->on('supplier');

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('event');

            $table->unique(['supplier_id', 'supplier_partner_id', 'event_id']);

            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('supplier_staff');

            $table->uuid('updated_by');
            $table->foreign('updated_by')->references('id')->on('supplier_staff');

            $table->timestamps();
        });

        Schema::create('event_supplier_collab_segment', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('event_supplier_collab_id');
            $table->foreign('event_supplier_collab_id')->references('id')->on('event_supplier_collab');

            $table->uuid('event_segment_id');
            $table->foreign('event_segment_id')->references('id')->on('event_segment');

            $table->unique(['event_supplier_collab_id', 'event_segment_id']);

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_supplier_collab_segment');
        Schema::dropIfExists('event_supplier_collab');
        Schema::dropIfExists('event_segment_staff');
        Schema::dropIfExists('event_segment');
        Schema::dropIfExists('event_supplier');
        Schema::dropIfExists('event');
    }
};
