<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Articulo extends Model
{
    protected $table = 'articulos';

    protected $fillable = [
        'titulo',
        'contenido',
        'slug',
        'estado',
        'fecha_publicacion',
        'user_id'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(
            Categoria::class,
            'articulo_categoria',
            'articulo_id',
            'categoria_id'
        );
    }
}
