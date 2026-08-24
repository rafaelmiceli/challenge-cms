<?php

namespace App\Exceptions;

use RuntimeException;

class UserAlreadyExistsException extends RuntimeException
{
    public function __construct(string $email)
    {
        parent::__construct(
            "User with email {$email} already exists."
        );
    }
}