<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 08/04/2016
 * Time: 05:01
 */

namespace ApiBundle\DataFixtures\ORM;

use ApiBundle\Utils\FakerTrait;
use ApiBundle\Utils\InitializeContainerTrait;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ApiBundle\Entity\Article;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ApiBundle\Entity\User;

class LoadArticleData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
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
        for($i = 0; $i < 5; $i++) {
            $this->createArticle($manager);
        }
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 20;
    }

    /**
     * @param ObjectManager $manager
     */
    private function createArticle(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle($this->faker->sentence(10));
        $article->setExcerpt($this->faker->paragraph(5));
        $article->setBody($this->faker->paragraph(20));
        $article->setUser($this->getRandomUser($manager));
        $manager->persist($article);
        $manager->flush();
    }

    private function getRandomUser(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        shuffle($users);
//        return $users[0] ?? null;
        return isset($users[0]) ? $users[0] : null;
    }
}