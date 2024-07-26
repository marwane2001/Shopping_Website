<?php

namespace App\Form;

use App\Entity\Adress;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('addresses',EntityType::class, [
                'label' => 'Choose one of your addresses',
                'required' => true,
                'class' => Adress::class,
                'expanded' => true,
                'choices'=>$options['addresses'],
                'label_html'=>true
            ])
            ->add('carrier',EntityType::class, [
                'label' => 'Choose one of your Shipping methods',
                'required' => true,
                'class' => Carrier::class,
                'expanded' => true,
                'label_html'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'addresses'=>null
        ]);
    }
}
