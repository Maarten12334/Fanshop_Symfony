<?php

namespace App\Form\gift;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class GiftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('choice', ChoiceType::class, [
                'label' => 'Keuzes:',
                'choices' => [
                    'Rode Sjaal' => 1,
                    'Zwarte Sjaal' => 2,
                    'Pet' => 3,
                    'Vlag' => 4,
                ],
                'choice_attr' => function ($choice, $key, $value) {
                    $images = [
                        1 => '/images/rode_sjaal.jpg',
                        2 => '/images/zwarte_sjaal.jpg',
                        3 => '/images/pet.jpg',
                        4 => '/images/vlag.jpg',
                    ];
                    return ['data-image' => $images[$value]];
                },
                'expanded' => true,
                'multiple' => false,
            ]);
    }
}
