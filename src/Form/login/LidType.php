<?php

namespace App\Form\login;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Lid;

class LidType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('geboortedatum', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Geboortedatum',
            ])
            ->add('lidnummer', IntegerType::class, [
                'label' => 'Lidnummer',
            ]);
    }
}
