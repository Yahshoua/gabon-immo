<?php

namespace App\DataFixtures;
use App\Entity\Auteur;
use App\Entity\Photos;
use App\Entity\Category;
use Faker\Factory as fk;
use App\Entity\Appartement;
use App\Repository\AuteurRepository;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppartementFixtures extends Fixture
{
    private $cate;
    private $type;
    private $auteur;
    public function __construct(CategoryRepository $cate,  AuteurRepository  $auteur) {
        $this->cate = $cate;
        $this->type = $type;
        $this->auteur = $auteur;
    }
    public function load(ObjectManager $manager)
    {
        $faker = fk::create("fr_FR");;
        for($i= 0;$i < 5; $i++) {
            $appartement = new Appartement();

            // $pickType = $this->type->find(1);
            // $pickCate = $this->cate->find(1);
            // $pickAuteur = $this->auteur->find(3);
            $pickCate = new Category();
            $photo = new Photos();
            $photo->setImage($faker->imageUrl);
            $pickCate->setLabel($faker->word(mt_rand(1, 5), true));
            $pickAuteur = new Auteur();
            $pickAuteur->setNom($faker->Name);
            $pickAuteur->setEmail($faker->email);
            $spec = array();
           
            for($i=0;$i < mt_rand(1, 5);$i++) {
                $word = $faker->word(5, true);
                $spec[] = $word;
            } 
            $appartement->setTitle($faker->words(3, true))
                        ->setQuartier($faker->address)
                        ->setPrix($faker->numberBetween(100, 1000))
                        ->setCreatedAt($faker->dateTime)
                        ->setVille($faker->city)
                        ->setCaracteristiques($spec)
                        ->setSpecifications('rien')
                        ->setAnneeDeConstruction($faker->year)
                        ->setDouches($faker->randomDigit)
                        ->setParking($faker->randomDigit)
                        ->setGarage($faker->randomDigit)
                        ->setSurface($faker->randomDigit)
                        ->setChambres($faker->randomDigit)
                        ->setEtages($faker->randomDigit)
                        ->setPiscines($faker->randomDigit)
                        ->setSalons($faker->randomDigit)
                        ->setBalcons($faker->randomDigit)
                        ->setCuisines($faker->randomDigit)
                        ->setassurance($faker->boolean)
                        ->setAuteur($pickAuteur)
                        ->setCategory($pickCate);
                        $photo->setAppartement($appartement);
                        $manager->persist($appartement);
                        $manager->persist($pickType);
                        $manager->persist($pickCate);
                        $manager->persist($pickAuteur);
                        $manager->persist($photo);
        }
        $manager->flush();
    }
}
