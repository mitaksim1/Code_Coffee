<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface 
{     
    private $encoder;  

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
        public function load(ObjectManager $manager): void
        {
            $date = new DateTimeImmutable();
            
            $user = new User();
            $user->setFirstname('Miriam');
            $user->setLastname('Simonnet');
            $user->setEmail('miriam@miriam.com');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->encoder->encodePassword($user, 'miriam'));
            $user->setLastname('Simonnet');
            $user->setLocalisation('Limoges');
            $user->setCreatedAt($date);
            $user->setUpdatedAt($date);
            $user->setIsActive(true);

            $this->addReference('geogeo', $user);
            
            $manager->persist($user);
            
            $manager->flush();
        }

        public function getOrder(){
            return 1;
        }
    }