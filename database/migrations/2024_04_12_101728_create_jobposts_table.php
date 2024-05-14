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

        Schema::create('jobposts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->string('type');
            $table->string('title');
            $table->text('content');
            $table->string('job_state');
            $table->string('job_zip');
            $table->string('job_city');
            $table->string('job_street');
            $table->string('job_house_nr');
            $table->string('job_address_addition')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('payed')->default(false);
            $table->string('duration')->nullable()->default(null);
            $table->timestamps();

        });

        Schema::create('job_post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobpost_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('jobposts');
        Schema::dropIfExists('job_post_tag');
    }
};
