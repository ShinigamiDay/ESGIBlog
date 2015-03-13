<?php

namespace ESGI\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddImageFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $img = new Image();
        $img->setAlt('testAddImageFixture');
        $img->setPath('5500283c54d9c.png');

//        $file = new UploadedFile('5500283c54d9c.png', 'Image1', null, null, null, true);
//        $img->setFile($file);

        $manager->persist($img);
        $this->addReference('img', $img);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}