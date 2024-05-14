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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('legal_form');
            $table->string('tax_id');
            $table->string('logo')->nullable();
            $table->string('industry');
            $table->string('contact_email')->nullable();
            $table->string('contat_phone')->nullable();
            $table->string('company_state');
            $table->string('company_zip');
            $table->string('company_city');
            $table->string('company_street');
            $table->string('company_house_nr');
            $table->string('company_address_addition')->nullable();

            $table->timestamps();
        });

        Schema::create('company_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_user');
    }
};
