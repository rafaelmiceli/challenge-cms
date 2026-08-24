<?php

namespace App\Exceptions;

use RuntimeException;

class CategoryNotFoundException extends RuntimeException
{
    public function __construct(int $id)
    {
        parent::__construct(
            "Category with ID {$id} was not found."
        );
    }
}