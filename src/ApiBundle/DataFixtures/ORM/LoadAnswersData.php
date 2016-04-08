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
use ApiBundle\Entity\Answer;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ApiBundle\Entity\Article;

class LoadAnswersData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
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
        for($i = 0; $i < 15; $i++) {
            $this->createAnswer($manager);
        }
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 30;
    }

    /**
     * @param ObjectManager $manager
     */
    private function createAnswer(ObjectManager $manager)
    {
        $article = new Answer();
        $article->setName($this->faker->name);
        $article->setBody($this->faker->paragraph(20));
        $article->setArticle($this->getRandomArticle($manager));
        $article->setRating(rand(1,5));
        $manager->persist($article);
        $manager->flush();
    }

    private function getRandomArticle(ObjectManager $manager)
    {
        $userManager = $manager->getRepository('ApiBundle:Article');
        $articles = $userManager->findAll();
        shuffle($articles);
//        return $articles[0] ?? null;
        return isset($articles[0]) ? $articles[0] : null;
    }
}