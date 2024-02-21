<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DateFormatValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!\DateTime::createFromFormat($constraint->format, $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->setParameter('{{ format }}', $constraint->format)
                ->addViolation();
        }
    }
}