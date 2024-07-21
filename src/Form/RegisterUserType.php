<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,['label'=>'Entrez votre adresse email','attr'=>[
                'placeholder'=>'Entrez votre adresse email',
            ]])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints'=>[new Length(['min'=>6,'max'=>30])],
                'first_options'  => ['label' => 'Mot de passe', 'hash_property_path' => 'password','attr'=>['placeholder'=>'Mot de passe']],
                'second_options' => ['label' => 'Repetez le mot de passe', 'hash_property_path' => 'password','attr'=>['placeholder'=>'Repetez le mot de passe']],
                'mapped' => false,
            ])
            ->add('firstname',TextareaType::class,['label'=>'Entrez votre prenom','attr'=>[
                'placeholder'=>'Entrez votre prenom'
            ],'constraints'=>[new Length(['min'=>2,'max'=>30])],])
            ->add('lastname',TextareaType::class,['label'=>'Entrez votre nom','attr'=>['placeholder'=>'Entrez votre nom'],'constraints'=>[new Length(['min'=>2,'max'=>30])],])
            ->add('Valider',SubmitType::class,['attr'=>['class'=>'btn btn-success']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'constraints' => [new UniqueEntity([
                'entityClass' => User::class,
                'fields' => ['email'],
            ])]
        ]);
    }
}
