<?php

namespace App\Exceptions;

use RuntimeException;

class CannotDeleteLastAdminException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            "Can not delete last admin."
        );
    }
}