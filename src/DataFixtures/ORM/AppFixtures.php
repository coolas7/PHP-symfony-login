<?php
namespace App\DataFixtures\ORM;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{

	private $encoder;

public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder = $encoder;
}

    public function load(ObjectManager $manager)
    {
       
            $Users = new Users();
            $Users->setUsername('admin');   
            $password = $this->encoder->encodePassword($Users, '123');
    		$Users->setPassword($password);
            $Users->setEmail('mail@gmail.com');
            $Users->setUsertype('admin');
            $manager->persist($Users);

        $manager->flush();
    }
}