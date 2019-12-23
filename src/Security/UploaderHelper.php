<?php

namespace App\Security;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    private $uploadPath;

    public function __construct(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    public function uploadImage(File $file, ?string $oldFilename = null): string
    {
        $destination = $this->uploadPath;
        if($file instanceof UploadedFile) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        }
        else{
            $originalFilename = $file->getFilename();
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();

        $file->move(
            $destination,
            $newFilename
        );

        if($oldFilename){
            @unlink($this->uploadPath.'/'.$oldFilename);
        }

        return $newFilename;
    }

    /**
     * @param $oldFilename
     */
    public function deleteImage($oldFilename)
    {
        @unlink($this->uploadPath.'/'.$oldFilename);
    }
}