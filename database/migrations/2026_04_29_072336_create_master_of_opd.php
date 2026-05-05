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
        Schema::create('master_of_opd', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_akronim', 50);
            $table->string('name_of_head');
            $table->string('position_head', 100);
            $table->string('number_phone', 12)->nullable();
            $table->string('address');
            $table->string('poscode', 6);
            $table->string('mail_opd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_of_opd');
    }
};
