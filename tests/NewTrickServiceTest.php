<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Trick;
use App\Security\UploaderHelper;
use App\Service\NewTrickService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class NewTrickServiceTest extends TestCase
{
    /**
     * @var NewTrickService
     */
    private $newTrickService;

    protected function setUp()
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $uploaderHelper = $this->createMock(UploaderHelper::class);

        $this->newTrickService = new NewTrickService($em, $uploaderHelper);

        return $this->newTrickService;
    }

    public function trickProviderOk()
    {
        $trick = new Trick();
        $trick->setname('toto')
            ->setDescription('toto')
            ->setCategory(new Category())
            ->setCreatedAt(new \DateTime())
            ->setSlug('toto');

        $trick2 = new Trick();
        $trick2->setname('tata')
            ->setDescription('tata')
            ->setCategory(new Category())
            ->setCreatedAt(new \DateTime())
            ->setSlug('tata');

        return [
                [$trick],
                [$trick2]
        ];
    }

    public function trickProviderNotOk()
    {
        $trick = new Trick();
        $trick->setname('')
            ->setDescription('toto')
            ->setCategory(new Category())
            ->setCreatedAt(new \DateTime())
            ->setSlug('toto');

        $trick2 = new Trick();
        $trick2->setname('toto')
            ->setDescription('')
            ->setCategory(new Category())
            ->setCreatedAt(new \DateTime())
            ->setSlug('toto');

        return [
            [$trick],
            [$trick2]
        ];
    }

    /**
     * @dataProvider trickProviderOk
     */
    public function testNewTrickOk($trick)
    {
        $test = $this->newTrickService->newTrick($trick);

        $this->assertInstanceOf(Trick::class, $test);
    }

    /**
     * @dataProvider trickProviderNotOk
     */
    public function testNewTrickNotOk($trick)
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->newTrickService->newTrick($trick);
    }
}
