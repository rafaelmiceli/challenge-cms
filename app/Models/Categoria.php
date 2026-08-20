<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function articulos()
    {
        return $this->belongsToMany(
            Articulo::class,
            'articulo_categoria',
            'categoria_id',
            'articulo_id'
        );
    }
}
