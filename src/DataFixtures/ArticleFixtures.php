<?php

namespace App\DataFixtures;
use Faker\Factory as fk;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = fk::create("fr_FR");
        for($i=1;$i< 3;$i++) {
            $article = new Article();
            $article->setTitle($faker->word(5, true))
                    ->setAuthor($faker->name)
                    ->setContent($faker->text)
                    ->setCreatedAt($faker->dateTime($max = 'now', $timezone = null))
                    ->setimageFile($faker->imageUrl(640,480));
            $manager->persist($article);  
        }
        
        $manager->flush();
    }
}
