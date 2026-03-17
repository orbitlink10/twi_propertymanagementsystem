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
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedInteger('units_count')->nullable()->after('property_type');
            $table->string('contact_phone')->nullable()->after('location');
            $table->string('contact_email')->nullable()->after('contact_phone');
            $table->text('description')->nullable()->after('contact_email');
            $table->text('notes')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'units_count',
                'contact_phone',
                'contact_email',
                'description',
                'notes',
            ]);
        });
    }
};
