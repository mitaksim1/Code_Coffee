<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use App\Entity\User;
use App\Entity\UserTechnology;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class UserTechnologyFixtures extends Fixture implements OrderedFixtureInterface 
{     
    private $encoder;  

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
        public function load(ObjectManager $manager): void
        {
            $date = new DateTimeImmutable();
            
            $userTechnology = new UserTechnology();
            $userTechnology->setTechnology($this->getReference('PHP'));
            $userTechnology->setUser($this->getReference('miriam'));
            $userTechnology->setExperience(5);
            $userTechnology->setCommentary('Commentaire');
            
            $manager->persist($userTechnology);
            
            $manager->flush();
        }

        public function getOrder(){
            return 3;
        }
    }