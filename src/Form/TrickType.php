<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('category', EntityType::class, [
                "label" => "Title",
                'choice_label' => 'title',
                "class" => Category::class,
                "query_builder" => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder("u")->orderBy('u.title', 'ASC');
                }
            ])
            ->add('images', CollectionType::class, array(
                'entry_type' => AddImageFormType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'prototype' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => "addImageCollection"
                ]
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
