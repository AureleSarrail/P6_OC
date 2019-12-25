<?php


namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class IframeToUrl implements DataTransformerInterface
{

    public function transform($url)
    {
        return $url;
    }

    public function reverseTransform($iframe)
    {
        $reg = '/(https:\/\/.*?)(?=")/';
        if (preg_match($reg, $iframe)) {
            preg_match($reg, $iframe, $matches);
            $url = $matches[0];
            return $url;
        }
    }

}