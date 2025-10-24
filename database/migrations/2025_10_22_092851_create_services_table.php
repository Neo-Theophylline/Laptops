<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Identitas & relasi
            $table->string('no_invoice')->unique();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('technician_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('laptop_id')->constrained('laptops')->onDelete('cascade');

            // Detail service
            $table->text('damage_description')->nullable();
            $table->integer('estimated_cost')->default(0);
            $table->integer('other_cost')->default(0);
            $table->integer('total_cost')->default(0);
            $table->integer('paid')->default(0);
            $table->integer('change')->default(0);

            // Pembayaran
            $table->enum('paymentmethod', ['cash', 'transfer'])->default('cash');
            $table->enum('payment_status', ['paid', 'debt', 'unpaid'])->default('unpaid');

            // Status service
            $table->enum('status', ['accepted', 'process', 'finished', 'taken', 'cancelled'])->default('accepted');

            // Tanggal penting
            $table->dateTime('received_date')->nullable();
            $table->dateTime('completed_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
