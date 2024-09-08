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
        Schema::create('service_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->text('service_description');
            $table->string('main_image');
            $table->string('subtitle');
            $table->string('first_section_image');
            $table->string('first_section_title');
            $table->string('second_section_image');
            $table->string('second_section_title');
            $table->string('summary_title');
            $table->text('summary_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_details');
    }
};
