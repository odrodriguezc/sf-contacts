<?php

namespace App\DataFixtures;


use App\Entity\User;
use App\DataFixtures\AbstractFixtures;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends AbstractFixtures
{

    protected UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder =  $encoder;
    }


    public function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 5, function (user $user, $u) {
            $role = $u === 0 ? 'ROLE_ADMIN' : 'ROLE_USER';
            $user
                ->setEmail("user{$u}@exemple.fr")
                ->setPassword($this->encoder->encodePassword($user, '12345'))
                ->setRoles([$role]);

            //Create 10 contacts by user
            for ($x = 0; $x < 10; $x++) {
                $contact = new Contact();
                $contact
                    ->setFirstName($this->faker->firstName())
                    ->setLastName($this->faker->lastName())
                    ->setEmail($this->faker->email())
                    ->setPhone($this->faker->phoneNumber())
                    ->setCreatedAt($this->faker->dateTimeBetween('- 6 months'))
                    ->setAddress($this->faker->address)
                    ->setUser($user);
                $this->manager->persist($contact);
            }
        });
    }
}
