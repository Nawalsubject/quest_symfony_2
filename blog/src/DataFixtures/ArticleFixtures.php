<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');

        for ($i=0 ; $i <= 50; $i++) {
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->catchPhrase()));
            $article->setContent($faker->realText());
            $article->setCategory($this->getReference('category_' . rand(0,6)));
            $manager->persist($article);
        }

        $manager->flush();
    }
}
