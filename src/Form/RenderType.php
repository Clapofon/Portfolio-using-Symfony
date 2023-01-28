<?php

namespace App\Form;

use App\Entity\Render;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Project;

class RenderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class)
            ->add('description')
            ->add('project', EntityType::class, [
                'class' => Project::class
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'button',
                    'value' => 'Add Render'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Render::class,
        ]);
    }
}
