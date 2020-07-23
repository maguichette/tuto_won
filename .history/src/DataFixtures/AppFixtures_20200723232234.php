<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $repo;
 public function __construct(RegionRepository $repo){
 $this->repo=$repo;
 

    public function load(ObjectManager $manager)
    {
                $regions=$this->repo->findAll();
        $faker = Factory::create('fr_FR');
        //Insertion des Regions
        foreach($regions as $region){

        $departement=new Departement();
        $departement->setCode($faker->postcode)
        ->setNom($faker->city)
        ->setRegion($region);
        $manager->persist( $departement);
        //Pour chaque Département, on insére 10 Communes
        for ($i=0; $i <10 ; $i++) {
        $commune=new Commune();
        $commune->setCode($faker->postcode)
        ->setNom($faker->city)
        ->setDepartement($departement);
        $manager->persist($commune);
        }
        }
 $manager->flush();

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
