<?php

namespace FractalizeR\LibrarianBundle\LibrarianBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use FractalizeR\LibrarianBundle\Logic\Domain\Author\Entity\Author;

/**
 * Class LoadArticleData
 *
 * @package FractalizeR\LibrarianBundle\LibrarianBundle\DataFixtures\ORM
 */
class LoadAuthorData implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 1000; $i++) {
            $author = new Author($faker->name);
            $author->www = $faker->url;
            $author->shortBio = $faker->sentence();
            $manager->persist($author);
        }
        $manager->flush();
    }
}
