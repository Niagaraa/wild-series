<?php

namespace App\Form;

use App\Entity\Season;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('program', null, [
                'choice_label' => 'title',
                'label' => 'Série liée'
            ])
            ->add('number', IntegerType::class, ['label' => 'Numéro de la saison'])
            ->add('description', TextareaType::class, ['label' => 'Résumé de la saison'])
            ->add('year', IntegerType::class, ['label' => 'Année de sortie']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }
}
