<?php

namespace App\Form;

use App\Entity\Episode;
use App\Entity\Program;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre de l\'épisode'])
            ->add('number', IntegerType::class, ['label' => 'Numéro de l\'épisode dans la saison'])
            ->add('synopsis', TextareaType::class, ['label' => 'Résumé de l\'épisode'])
            ->add('season', null, [
                'choice_label' => 'id',
                'label' => 'Saison liée à cet épisode'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Episode::class,
        ]);
    }
}
