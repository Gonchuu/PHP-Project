<?php

namespace App\Form;

use App\Entity\Familia;
use App\Entity\JuegoDeTronos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType as TypeSubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JuegoDeTronosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('image')
            ->add('number')
            ->add(
                'familias',
                EntityType::class,
                [
                    "class" => Familia::class,
                    "choice_label" => "name",
                    "multiple" => true,
                    "expanded" => true
                ]
            )

            ->add('submit', TypeSubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JuegoDeTronos::class,
        ]);
    }
}
