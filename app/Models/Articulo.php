<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

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

    protected function titulo(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $this->attributes['slug'] = Str::slug($value);

                return $value;
            },
        );
    }

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
