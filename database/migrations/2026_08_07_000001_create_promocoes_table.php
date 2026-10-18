<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('promocoes')) {
            Schema::create('promocoes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('estampa_id');
                $table->enum('tipo', ['percent', 'fixed'])->default('percent');
                $table->decimal('valor', 8, 2)->default(0.00);
                $table->timestamp('inicio')->nullable();
                $table->timestamp('fim')->nullable();
                $table->boolean('ativo')->default(true);
                $table->timestamp('data_criacao')->useCurrent();
                $table->timestamp('data_atualizacao')->useCurrent()->useCurrentOnUpdate();

                $table->foreign('estampa_id')->references('id')->on('estampas')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('promocoes');
    }
};
