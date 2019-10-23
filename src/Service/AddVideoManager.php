<?php


namespace App\Service;


class AddVideoManager
{

    public function getSrc($iframe) {

        //On ne récupère que le contenu de src de la iframe donnée par l'utilisateur
        $debutSrc = strpos($iframe, "http");
        $finSrc = strpos($iframe, "\"", $debutSrc);
        $length = $finSrc - $debutSrc;
        $url = substr($iframe, $debutSrc, $length);

        return $url;
    }
    
}