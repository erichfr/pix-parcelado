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
        Schema::create('payment_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->onDelete('cascade');
            $table->integer('numero_parcela');
            $table->decimal('valor', 10, 2);
            $table->date('data_vencimento');
            $table->enum('status', ['pendente', 'pago', 'vencido'])->default('pendente');
            $table->string('pix_code')->nullable(); // código ou chave gerada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
