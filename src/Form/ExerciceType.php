<?php

namespace App\Form;

use App\Entity\Exercice;
use App\Entity\Enum\WeekEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'exercice',
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200',
                    'rows' => 3
                ]
            ])
            ->add('duration', NumberType::class, [
                'label' => 'Durée (en minutes)',
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200'
                ]
            ])
            ->add('session', TextType::class, [
                'label' => 'Session',
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200',
                    'placeholder' => 'Ex: Session 1, Échauffement, etc.'
                ]
            ])
            ->add('week', EnumType::class, [
                'class' => WeekEnum::class,
                'label' => 'Semaine',
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
} 