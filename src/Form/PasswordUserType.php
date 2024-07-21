<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class PasswordUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actual-password',PasswordType::class,[
                'label' => 'Mot de passe actuel','attr'=>[
                    'placeholder'=>'Mot de passe actuel'
                ],'mapped'=> false,

            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints'=>[new Length(['min'=>6,'max'=>30])],
                'first_options'  => ['label' => 'Votre Nouveau mot de passe', 'hash_property_path' => 'password','attr'=>['placeholder'=>'Mot de passe']],
                'second_options' => ['label' => 'Confirmez votre mot de passe', 'hash_property_path' => 'password','attr'=>['placeholder'=>'Repetez le mot de passe']],
                'mapped' => false,
            ])
            ->add(
                'submit',SubmitType::class,[
                    'label' => 'Modifier le mot de passe',
                    'attr'=>[
                        'class'=>'btn btn-success'
                    ]
                ]
            )
            ->addEventListener(
                FormEvents::SUBMIT,
                function (
                    FormEvent $event
                )
                {
                    $form = $event->getForm();
                    $user=$form->getConfig()->getOptions()['data'];
                    $passwordHasher= $form->getConfig()->getOptions()['passwordHasher'];
                    $isValid=$passwordHasher->isPasswordValid($user,$form->get(
                        'actual-password'
                    )->getData());
                    if(!$isValid){
                        $form->get('actual-password')->addError(new FormError("Mot de passe actuel n'est pas conforme,Veuillez le verifier"));
                    }
                }
            )



        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'passwordHasher'=>null
        ]);
    }
}
