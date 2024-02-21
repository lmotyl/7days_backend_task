<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class DateFormat extends Constraint
{
    public $message = 'The date "{{ value }}" does not match the format "{{ format }}".';
    public $format;

    public function __construct($options = null)
    {
        parent::__construct($options);
        if ($this->format === null) {
            $this->format = 'Y-m-d'; // Default format
        }
    }

    public function validatedBy()
    {
        return DateFormatValidator::class;
    }
}