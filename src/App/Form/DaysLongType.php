<?php

namespace App\Form;

use App\Validator\Constraints\DateFormat;
use App\Validator\Constraints\TimezoneName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DaysLongType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, [
                'constraints' => [
                    new DateFormat(['format' => 'Y-m-d'])
                ]
            ])
            ->add('timezone', TextType::class, [
                'constraints' => [
                    new TimezoneName()
                ]
            ])
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
