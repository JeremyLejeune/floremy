<?php
/**
 * Created by PhpStorm.
 * User: silve
 * Date: 23/02/2018
 * Time: 13:58
 */
namespace AppBundle\DataFixtures;
use AppBundle\Entity\Films;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
class FilmFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $film = new Films();
        $film
            ->setAuthor('test')
            ->setCategory(0)
            ->setDate(new \DateTime())
            ->setDescription('test')
            ->setDuration(200)
            ->setTitle('test')
            ->setBrochure('web/Ressources/img/icone.jpg');
        $manager->persist($film);
        $manager->flush();
    }
}