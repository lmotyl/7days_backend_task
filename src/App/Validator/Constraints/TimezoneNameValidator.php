<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TimezoneNameValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!in_array($value, timezone_identifiers_list())) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ timezone }}', $value)
                ->addViolation();
        }
    }
}
