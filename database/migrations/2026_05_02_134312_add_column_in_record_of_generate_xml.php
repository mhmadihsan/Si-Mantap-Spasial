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
        Schema::table('record_of_generate_xml', function (Blueprint $table) {
            $table->unsignedBigInteger('master_opd_id')->nullable()->after('id');
            $table->foreign('master_opd_id')->references('id')->on('master_of_opd')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('record_of_generate_xml', function (Blueprint $table) {
            $table->dropForeign(['master_opd_id']);
            $table->dropColumn('master_opd_id');
        });
    }
};
