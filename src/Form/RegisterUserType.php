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
            ->add('email',EmailType::class,['label'=>'E-mail','attr'=>[
                'placeholder'=>'Enter your e-mail',
            ]])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints'=>[new Length(['min'=>6,'max'=>30])],
                'first_options'  => ['label' => 'Password', 'hash_property_path' => 'password','attr'=>['placeholder'=>'Password']],
                'second_options' => ['label' => 'Repeat Password', 'hash_property_path' => 'password','attr'=>['placeholder'=>'Password']],
                'mapped' => false,
            ])
            ->add('firstname',TextareaType::class,['label'=>'Firstname','attr'=>[
                'placeholder'=>'Enter your name',
            ],'constraints'=>[new Length(['min'=>2,'max'=>30])],])
            ->add('lastname',TextareaType::class,['label'=>'Lastname','attr'=>['placeholder'=>'Enter your last name'],'constraints'=>[new Length(['min'=>2,'max'=>30])],])
            ->add('Submit',SubmitType::class,['attr'=>['class'=>'btn btn-success']])

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
