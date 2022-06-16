<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class TechnologyFixtures extends Fixture implements OrderedFixtureInterface 
{     
    private $encoder;  

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
        public function load(ObjectManager $manager): void
        {
            $date = new DateTimeImmutable();
            
            $technology = new Technology();
            $technology->setName('PHP');
            $technology->setCreatedAt($date);
            $technology->setUpdatedAt($date);
            $technology->setIsActive(true);

            $this->addReference('PHP', $technology);
            
            $manager->persist($technology);
            
            $manager->flush();
        }

        public function getOrder(){
            return 2;
        }
    }