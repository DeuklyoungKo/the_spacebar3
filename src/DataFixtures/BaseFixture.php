<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-10
 * Time: 오후 3:48
 */

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{

    /** @var Generator */
    protected $faker;

    private $manager;

    abstract protected function loadData(ObjectManager $em);

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create();

        $this->loadData($manager);

    }

    protected function createMany(string $className, int $count, callable $factory)
    {
        for($i=0;$i<$count;$i++){

            $entity = new $className();
            $factory($entity, $i);

            $this->manager->persist($entity);

            // store for usage later as App\entity\ClassName_#COUNT#
            $this->addReference($className .'_'.$i,$entity);
        }
    }
}