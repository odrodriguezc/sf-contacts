<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Firstname'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Lastname'
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone Number'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('address', TextType::class, [
                'label' => 'Address'
            ])
            ->add('user', EntityType::class, [
                'label' => 'User',
                'class' => User::class,
                'choice_label' => 'email'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
