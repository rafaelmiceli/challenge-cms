<?php

namespace App\Exceptions;

use RuntimeException;

class CategoryHasProductsException extends RuntimeException
{
    public function __construct(int $id)
    {
        parent::__construct(
            "Category with ID {$id} cannot be deleted because it has associated products."
        );
    }
}