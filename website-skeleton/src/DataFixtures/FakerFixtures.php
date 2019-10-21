<?php
namespace App\DataFixtures;

use App\Entity\User;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // 1. Configuration de Faker
        // On crée une instance de Faker en français
        $generator = Faker\Factory::create('fr_FR');
        // On passe le Manager de Doctrine à Faker
        $populator = new Faker\ORM\Doctrine\Populator($generator, $manager);

        // 2. Fixtures

        // Admin
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@admin.com');
        $admin->setPassword('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setAddressLabel('Chez l\'admin');
        $admin->setLat(rand(-90, 90));
        $admin->setLng(rand(-180, 180));
        // On persiste notre user
        $manager->persist($admin);

        // Users
        $populator->addEntity('App\Entity\User', 20, array(
            'username' => function () use ($generator) {
                return $generator->unique()->userName();
            },
            'email' => function () use ($generator) {
                return $generator->unique()->email();
            },
            'password' => function () use ($generator) {
                return $generator->password();
            },
            'roles' => function () {
                return ['ROLE_USER'];
            },
            'addressLabel' => function () use ($generator) {
                return $generator->address;
            },
            'lat' => function () use ($generator) {
                return $generator->latitude;
            },
            'lng' => function () use ($generator) {
                return $generator->longitude;
            },
        ));

        // Post-Status
        $populator->addEntity('App\Entity\PostStatus', 3, array(
            'label' => function () use ($generator) {
                return $generator->word();
            },
        ));

        // Visibilities
        $populator->addEntity('App\Entity\Visibility', 3, array(
            'label' => function () use ($generator) {
                return $generator->word();
            },
        ));

        // Categories
        $populator->addEntity('App\Entity\Category', 5, array(
            'label' => function () use ($generator) {
                return $generator->word();
            },
        ));

        // Wear-Conditions
        $populator->addEntity('App\Entity\WearCondition', 3, array(
            'label' => function () use ($generator) {
                return $generator->word();
            },
        ));    
        
        // Posts
        $populator->addEntity('App\Entity\Post', 20, array(
            'title' => function () use ($generator) {
                return $generator->sentence();
            },
            'description' => function () use ($generator) {
                return $generator->text();
            },
            'addressLabel' => function () use ($generator) {
                return $generator->address;
            },
            'lat' => function () use ($generator) {
                return $generator->latitude;
            },
            'lng' => function () use ($generator) {
                return $generator->longitude;
            },
            'nbLikes' => function () {
                return rand(0, 10);
            },
        ));

        // 3. On demande à Faker d'enregistrer les données en base
        $inserted = $populator->execute();

        $manager->flush();
    }
}