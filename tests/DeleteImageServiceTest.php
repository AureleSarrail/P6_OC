<?php

namespace App\Tests;

use App\Entity\Image;
use App\Entity\Trick;
use App\Security\UploaderHelper;
use App\Service\DeleteImageService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class DeleteImageServiceTest extends TestCase
{
    /**
     * @var DeleteImageService
     */
    private $deleteImageService;

    public function setUp()
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $uploaderHelper = $this->createMock(UploaderHelper::class);

        $this->deleteImageService = new DeleteImageService($em,$uploaderHelper);

        return $this->deleteImageService;
    }

    public function testDeleteImageServiceOk()
    {
        $image = new Image();
        $trick = new Trick();
        $image->setUrl('toto');
        $trick->addImage($image);


        $this->assertEquals($trick->getImages()->count(), 1);

        $test = $this->deleteImageService->deleteImage($image);
        $this->assertEquals($test->getImages()->count(), 0);

        $this->assertInstanceOf(Trick::class, $test);
    }
}
