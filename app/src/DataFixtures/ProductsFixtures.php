<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName((string)$faker->word);
            $product->setStock((int)rand(10, 100));
            $product->setNetPrice((int)rand(10, 100));
            $product->setGrossPrice((int)rand(10, 100));
            $product->setVatRate((int)rand(10, 100));;
            $manager->persist($product);
        }

        $manager->flush();
    }
}
