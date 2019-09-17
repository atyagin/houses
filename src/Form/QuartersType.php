<?php

namespace App\Form;

use App\Entity\Quarters;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\DataTransformer\IntegerToLocalizedStringTransformer;

class QuartersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('floor')
            ->add('rooms')
            ->add('square', NumberType::class, [
                'scale' => 2
            ])
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
