<?php

// src/Form/OffreType.php

namespace App\Form;

use App\Entity\Coupon;
use App\Entity\Offre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jeux')
            ->add('coupon', EntityType::class, [
                'class' => Coupon::class,
                'choice_label' => 'code'])
            ->add('prix', MoneyType::class)
            ->add('lien', UrlType::class)
            ->add('edition', TextType::class)
            ->add('plateformeJeu', TextType::class)
            ->add('plateformeActivation', TextType::class, [
                'required' => true
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
