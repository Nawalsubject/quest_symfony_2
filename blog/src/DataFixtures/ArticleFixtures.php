<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use App\Service\Slugify;
use App\Entity\User;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Slugify
     */
    private $slugify;

    /**
     * ArticleFixtures constructor.
     * @param Slugify $slugify
     */
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
/*        $faker  =  Faker\Factory::create('en_US');
        $slugify = new Slugify();

        for ($i=0; $i <= 50; $i++) {
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->catchPhrase()));
            $article->setSlug($slugify->generate($article->getTitle()));
            $article->setContent($faker->realText());
            $article->setAuthor($this->getReference('user_' . rand(0,1)));
            $article->setCategory($this->getReference('category_' . rand(0,6)));
            $nbRandom = rand(0, 3);
            for ($j = 0; $j <= $nbRandom; $j++) {
                $article->addTag($this->getReference('tag_' . rand(0, 5)));
            }
            $manager->persist($article);
        }*/

        for ($i = 1; $i <= 1000; $i++) {
            $category = new Category();
            $category->setName("category " . $i);
            $manager->persist($category);

            $tag = new Tag();
            $tag->setName("tag " . $i);
            $manager->persist($tag);

            $article = new Article();
            $article->setTitle("article " . $i);
            $article->setSlug($this->slugify->generate($article->getTitle()));
            $article->setContent("article " . $i . " content");
            $article->setCategory($category);
            $article->addTag($tag);
            $article->setAuthor($this->getReference('user_' . rand(0, 1)));
            $manager->persist($article);
        }

//        $manager->flush();

        $manager->flush();
    }
}
