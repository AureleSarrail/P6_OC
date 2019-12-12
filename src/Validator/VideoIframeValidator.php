<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VideoIframeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\VideoIframe */

        dump($value);

        if (null === $value || '' === $value) {
            return false;
        }

        if (strpos($value,'youtube') or strpos($value,'dailymotion') or strpos($value,'vimeo')) {
            return true;
        }

        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('CODE', $value)
            ->addViolation();
    }
}
