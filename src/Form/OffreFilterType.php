<?php


// src/Form/OffreFilterType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('edition', ChoiceType::class, [
                'choices' => [
                    'Standard' => 'standard',
                    'Collector' => 'collector',
                    'Deluxe' => 'deluxe',
                    'Ultimate' => 'ultimate',
                ],
                'required' => false,
                'placeholder' => 'Choose all editions',
            ])
            ->add('plateformeJeu', ChoiceType::class, [
                'choices' => [
                    'PC' => 'PC',
                    'PlayStation' => 'PlayStation',
                    'Xbox' => 'Xbox',
                    'Nintendo Switch' => 'Nintendo Switch',
                    'Mobile' => 'Mobile',
                ],
                'required' => false,
                'placeholder' => 'Choose all platforms',
            ])
            ->add('plateformeActivation', ChoiceType::class, [
                'choices' => [
                    'Steam' => 'Steam',
                    'Epic Games' => 'Epic Games',
                    'Origin' => 'Origin',
                    'Uplay' => 'Uplay',
                    'GOG' => 'GOG',
                ],
                'required' => false,
                'placeholder' => 'All Activation Platforms'
            ])
            ->add('sortByPrice', ChoiceType::class, [
                'choices' => [
                    'Ascending' => 'asc',
                    'Descending' => 'desc',
                ],
                'required' => false,
                'placeholder' => 'Sort by all prices',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
