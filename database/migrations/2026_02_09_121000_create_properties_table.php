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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('landlord_assignment')->default('use_my_business');
            $table->string('agent_assignment')->default('no_agent');
            $table->string('branch')->nullable();
            $table->string('property_type')->nullable();
            $table->string('location')->nullable();
            $table->string('paybill_number')->nullable();
            $table->string('account_format')->default('unit_number');
            $table->string('featured_image')->nullable();
            $table->decimal('service_charge', 5, 2)->default(0);
            $table->decimal('income_tax', 5, 2)->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
