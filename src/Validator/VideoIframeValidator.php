<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VideoIframeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\VideoIframe */

        if (null === $value || '' === $value) {
            return;
        }

        if (strpos($value,'youtube') or strpos($value,'dailymotion') or strpos($value,'vimeo')) {
            return;
        }

        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('XXXXXX', $value)
            ->addViolation();
    }
}
