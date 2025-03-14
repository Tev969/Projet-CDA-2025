<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du programme',
                'attr' => [
                    'placeholder' => 'Entrez le titre de votre programme',
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Décrivez votre programme',
                    'rows' => 5,
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200'
                ]
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Niveau de difficulté',
                'choices' => [
                    'Débutant' => 'Débutant',
                    'Intermédiaire' => 'Intermédiaire',
                    'Avancé' => 'Avancé'
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200'
                ]
            ])
            ->add('duration', ChoiceType::class, [
                'label' => 'Durée (en semaines)',
                'choices' => array_combine(range(1, 12), range(1, 12)),
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200'
                ]
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200',
                    'min' => 0,
                    'step' => '0.01',
                    'placeholder' => 'Entrez le prix du programme'
                ]
            ])
            ->add('photo', FileType::class, [
                'label' => 'Image du programme',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp'
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPEG, PNG, WEBP)',
                    ])
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-2 rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
