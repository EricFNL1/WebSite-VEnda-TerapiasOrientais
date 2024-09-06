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
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable()->after('user_id'); // Adiciona a coluna 'service_id' como unsignedBigInteger
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade'); // Define 'service_id' como chave estrangeira referenciando 'id' na tabela 'services'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['service_id']); // Remove a chave estrangeira
            $table->dropColumn('service_id'); // Remove a coluna 'service_id'
        });
    }
};

