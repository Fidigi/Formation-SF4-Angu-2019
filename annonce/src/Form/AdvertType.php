<?php

namespace App\Form;

use App\Entity\Advert;
use App\Entity\Person;
use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('updateAtDate')
            ->add('published')
            ->add( 'author', EntityType::class, [
                    'label'    => 'Auteur',
                    'class' => Person::class,
                    'choice_label' => function ($author) {
                        return $author->getDisplayName();
                    },
                ])
            ->add('image', ImageType::class)
            ->add('submit', SubmitType::class, [
                    'label'    => 'Créer'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advert::class,
        ]);
    }
}
