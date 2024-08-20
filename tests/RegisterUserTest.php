<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {
        //1
        $client = static::createClient();
        $client->request('GET', '/register');
        //2(fill form)
        $client->submitForm('Valider', [
            'register_user[email]'=>'marwanex@gmail.com',
            'register_user[plainPassword][first]'=>'Marwane21',
            'register_user[plainPassword][second]'=>'Marwane21',
            'register_user[firstname]'=>'Marwane',
            'register_user[lastname]'=>'Skaro',
        ]);
        //3
        $this->assertResponseRedirects('/connexion');
        $client->followRedirect();
        //4
        $this->assertSelectorExists(
            'div:contains("Vous avez creer votre compte aves succes!Veuillez vous connecter.")'
        );





        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }
}
