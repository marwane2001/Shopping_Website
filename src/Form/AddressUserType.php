<?php

namespace App\Form;

use App\Entity\Adress;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'label'=> 'Your Firstname',
                'attr'=>[
                    'placeholder'=>'Type in your Firstname...'
                ]
            ])
            ->add('LastName',TextType::class,[
                'label'=> 'Your Last Name',
                'attr'=>[
                    'placeholder'=>'Type in your Last name...'
                ]])
            ->add('address',TextType::class,[
                'label'=> 'Your Address',
                'attr'=>[
                    'placeholder'=>'Type in your Address...'
                ]])
            ->add('postal',TextType::class,[
                'label'=> 'Your Postal','attr'=>[
                    'placeholder'=>'Type in your Postal...'
                ]
            ])
            ->add('city',TextType::class,[
                'label'=> 'Your City','attr'=>[
                    'placeholder'=>'Type in your City...'
                ]
            ])
            ->add('country',CountryType::class,[
                'label'=> 'Your country'])
            ->add('phone',TextType::class,[
                'label'=> 'Your Phone Number','attr'=>[
                    'placeholder'=>'Type in your Phone Number...'
                ]
            ])
            ->add('Submit',SubmitType::class,['attr'=>['class'=>'btn btn-success btn-md']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
