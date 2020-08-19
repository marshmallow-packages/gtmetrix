<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGtMetrixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gtmetrixable', function (Blueprint $table) {
            $table->id();
            $table->morphs('gtmetrixable');
            $table->string('path')->nullable()->default(null);
            $table->string('gtmetrix_id')->nullable()->default(null);
            $table->string('poll_state_url')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->string('error')->nullable()->default(null);
            $table->string('report_url')->nullable()->default(null);
            $table->string('pagespeed_score')->nullable()->default(null);
            $table->string('yslow_score')->nullable()->default(null);
            $table->string('html_bytes')->nullable()->default(null);
            $table->string('html_load_time')->nullable()->default(null);
            $table->string('page_bytes')->nullable()->default(null);
            $table->string('page_load_time')->nullable()->default(null);
            $table->string('page_elements')->nullable()->default(null);
            $table->string('redirect_duration')->nullable()->default(null);
            $table->string('connect_duration')->nullable()->default(null);
            $table->string('backend_duration')->nullable()->default(null);
            $table->string('first_paint_time')->nullable()->default(null);
            $table->string('dom_interactive_time')->nullable()->default(null);
            $table->string('dom_content_loaded_time')->nullable()->default(null);
            $table->string('dom_content_loaded_duration')->nullable()->default(null);
            $table->string('onload_time')->nullable()->default(null);
            $table->string('onload_duration')->nullable()->default(null);
            $table->string('fully_loaded_time')->nullable()->default(null);
            $table->string('rum_speed_index')->nullable()->default(null);
            $table->string('resources_report_pdf')->nullable()->default(null);
            $table->string('resources_pagespeed')->nullable()->default(null);
            $table->string('resources_har')->nullable()->default(null);
            $table->string('resources_pagespeed_files')->nullable()->default(null);
            $table->string('resources_report_pdf_full')->nullable()->default(null);
            $table->string('resources_yslow')->nullable()->default(null);
            $table->string('resources_screenshot')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gtmetrixable');
    }
}
