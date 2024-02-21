<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class TimezoneName extends Constraint
{
    public $message = 'The timezone "{{ timezone }}" is not valid.';
}