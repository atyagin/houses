<?php

namespace App\Form;

use App\Entity\Quarters;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuartersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('floor')
            ->add('rooms')
            ->add('square')
            ->add('price')
            ->add('Type', EntityType::class, [
                'class' => \App\Entity\QuartersType::class,
                'label' => 'type'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quarters::class,
        ]);
    }
}
