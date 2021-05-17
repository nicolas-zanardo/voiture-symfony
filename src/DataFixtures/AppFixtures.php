<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $bmw = new Brand();
        $bmw->setLibelle("BMW");
        $manager->persist($bmw);

        $audi = new Brand();
        $audi->setLibelle("audi");
        $manager->persist($audi);

        $r8 = new Model();
        $r8->setLibelle("R8")
            ->setImage("audi_R8.jpg")
            ->setPrice(60000)
            ->setBrand($audi);
        $manager->persist($r8);

        $m3 = new Model();
        $m3->setLibelle("M3")
            ->setImage("BMW_m3.jpg")
            ->setPrice(55000)
            ->setBrand($bmw);
        $manager->persist($m3);

        $i = new Model();
        $i->setLibelle("i")
            ->setImage("i.png")
            ->setPrice(85000)
            ->setBrand($bmw);
        $manager->persist($i);

        $rsq8 = new Model();
        $rsq8->setLibelle("rsq8")
            ->setImage("rsq8.jpg")
            ->setPrice(75000)
            ->setBrand($audi);
        $manager->persist($rsq8);

        $models = [$r8, $rsq8, $m3, $i];

        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create('fr_FR');
        foreach ($models as $m) {
            $rand = rand(5, 10);
            for ($let = 1; $let <= $rand; $let++) {
                $car = new Car();
                $car->setImmatriculation($faker->regexify("[A-Z]{2}-[0-9]{3,4}-[A-Z]{2}"))
                    ->setDoorNb($faker->randomElement($array = array(3, 5)))
                    ->setYear($faker->numberBetween($nim = 2010, $max = 2020))
                    ->setModel($m);
                $manager->persist($car);
            }
        }

        $manager->flush();
    }
}
