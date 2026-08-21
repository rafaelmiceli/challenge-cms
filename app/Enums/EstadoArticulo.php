<?php

namespace App\Enums;

enum EstadoArticulo: string
{
    case BORRADOR = 'borrador';
    case PUBLICADO = 'publicado';
}