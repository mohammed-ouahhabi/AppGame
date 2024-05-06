<?php
// src/Form/JeuxType.php
namespace App\Form;

use App\Entity\Developpeur;
use App\Entity\Editeur;
use App\Entity\Jeux;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('dateSortie', DateType::class, [
                'widget' => 'single_text',  // Pour utiliser un input type="date"
            ])
            ->add('developpeur', EntityType::class, [
                'class' => Developpeur::class,
                'choice_label' => 'nom', // supposant que 'nom' est la propriété que vous voulez afficher
            ])
            ->add('editeur', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'nom', // Choisissez une propriété qui définit l'entité, comme 'nom'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeux::class,
        ]);
    }
}
