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
        Schema::table('services', function (Blueprint $table) {
            $table->string('category_type')->default('Telediagnóstico Estadual')->after('slug');
            $table->string('partner')->nullable()->after('category_type');
            $table->string('technical_responsible')->nullable()->after('partner');
            $table->string('response_time')->nullable()->after('technical_responsible');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['category_type', 'partner', 'technical_responsible', 'response_time']);
        });
    }
};
