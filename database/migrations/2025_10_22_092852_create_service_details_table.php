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
    $table->foreignId('service_item_id')->constrained('service_items')->onDelete('cascade');
    $table->integer('price')->default(0);
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
