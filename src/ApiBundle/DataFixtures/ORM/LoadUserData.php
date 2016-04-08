<?php

namespace ApiBundle\DataFixtures\ORM;

use ApiBundle\Utils\FakerTrait;
use ApiBundle\Entity\User;
use ApiBundle\Utils\InitializeContainerTrait;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use FakerTrait;
    use InitializeContainerTrait;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createUser($manager);
        $this->createUser($manager);
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 10;
    }

    /**
     * @param ObjectManager $manager
     */
    private function createUser(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername($this->faker->userName);
        $user->setPlainPassword('test');
        $user->setEmail($this->faker->email);
        $user->setEnabled(true);
//        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);
        $manager->flush();
    }

}