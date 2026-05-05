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
        Schema::create('walidata_profile', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')
                ->default(true);
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('agency');
            $table->string('number_phone', 100)->nullable();
            $table->string('fax_mail', 50)->nullable();
            $table->string('address');
            $table->string('name_of_district', 100)
                ->default('Kabupaten Hulu Sungai Selatan');
            $table->string('pos_code')->default('71214');
            $table->string('province_name')->default('Kalimantan Selatan');
            $table->string('mail_agency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walidata_profile');
    }
};
