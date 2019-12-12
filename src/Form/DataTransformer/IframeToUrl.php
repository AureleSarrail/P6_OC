<?php


namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class IframeToUrl implements DataTransformerInterface
{

    public function transform($iframe)
    {
        $debutSrc = strpos($iframe, "http");
        $finSrc = strpos($iframe, "\"", $debutSrc);
        $length = $finSrc - $debutSrc;
        $url = substr($iframe, $debutSrc, $length);

        return $url;
    }

    public function reverseTransform($iframe)
    {
        $debutSrc = strpos($iframe, "http");
        $finSrc = strpos($iframe, "\"", $debutSrc);
        $length = $finSrc - $debutSrc;
        $url = substr($iframe, $debutSrc, $length);

        return $url;
    }

}