<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VideoIframeValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     * @return bool
     */
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint VideoIframe */

        if (null === $value || '' === $value) {
            return false;
        }

        if (preg_match('/(http(s):\/\/www.youtube.com.*?)/',$value)
            or preg_match('/(http(s):\/\/www.dailymotion.com.*?)/',$value)
            or preg_match('/(http(s):\/\/www.vimeo.com.*?)/',$value)
        ) {
            return true;
        }

        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('CODE', $value)
            ->addViolation();
    }
}
