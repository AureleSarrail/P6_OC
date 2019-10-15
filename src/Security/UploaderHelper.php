<?php

namespace App\Security;

use App\Entity\Trick;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    private $uploadPath;

    public function __construct(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    public function uploadImage(UploadedFile $uploadedFile, ?string $oldFilename = null): string
    {
        $destination = $this->uploadPath;
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
        $uploadedFile->move(
            $destination,
            $newFilename
        );

        if($oldFilename){
            @unlink($this->uploadPath.'/'.$oldFilename);
        }

        return $newFilename;
    }
}