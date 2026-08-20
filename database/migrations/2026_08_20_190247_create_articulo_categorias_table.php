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
        Schema::create('articulo_categoria', function (Blueprint $table) {
            $table->id();

            $table->foreignId('articulo_id')
                ->constrained('articulos')
                ->cascadeOnDelete();

            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'articulo_id',
                'categoria_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo_categorias');
    }
};
