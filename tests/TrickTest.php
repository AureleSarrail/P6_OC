<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    public function testTrickGetName()
    {
        $trick = new Trick();
        $trick->setname('toto');

        $test = $trick->getName();

        $this->assertEquals('toto', $test);

        $trick->setname('tata');

        $test = $trick->getName();

        $this->assertEquals('tata', $test);
    }

    public function testTrickGetSlug()
    {
        $trick = new Trick();
        $trick->setSlug('toto');

        $test = $trick->getSlug();

        $this->assertEquals('toto', $test);
    }

    public function testTrickGetCategory()
    {
        $trick = new Trick();
        $trick->setCategory(new Category());
        $test = $trick->getCategory();

        $this->assertInstanceOf(Category::class, $test);
    }

    public function testTrickGetDescription()
    {
        $trick = new Trick();
        $trick->setDescription('toto');
        $test = $trick->getDescription();

        $this->assertEquals('toto',$test);
    }

    public function testTrickGetImages()
    {
        $trick = new Trick();
        $test = $trick->getImages();

        $this->assertInstanceOf(ArrayCollection::class, $test);
    }

    public function testTrickGetVideos()
    {
        $trick = new Trick();
        $test = $trick->getVideos();

        $this->assertInstanceOf(ArrayCollection::class, $test);
    }

    public function testTrickGetComments()
    {
        $trick = new Trick();
        $test = $trick->getComments();

        $this->assertInstanceOf(ArrayCollection::class,$test);
    }

    public function testTrickSetName()
    {
        $trick = new Trick();
        $test = $trick->setname('toto');

        $this->assertInstanceOf(Trick::class,$test);
    }

    public function testTrickSetDescription()
    {
        $trick = new Trick();
        $test = $trick->setDescription('toto');

        $this->assertInstanceOf(Trick::class,$test);
    }

    public function testTrickSetCategory()
    {
        $trick = new Trick();
        $test = $trick->setCategory(new Category());

        $this->assertInstanceOf(Trick::class, $test);
    }

    public function testTrickSetCreatedAt()
    {
        $trick = new Trick();
        $test = $trick->setCreatedAt(new \DateTime());

        $this->assertInstanceOf(Trick::class, $test);
    }

    public function testTrickSetUpdatedAt()
    {
        $trick = new Trick();
        $test = $trick->setUpdatedAt(new \DateTime());

        $this->assertInstanceOf(Trick::class, $test);
    }
}
