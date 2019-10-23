<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddVideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url');

        $builder->get('url')
            ->addModelTransformer(new CallbackTransformer(
                function ($iframe) {
                    $debutSrc = strpos($iframe, "http");
                    $finSrc = strpos($iframe, "\"", $debutSrc);
                    $length = $finSrc - $debutSrc;
                    $url = substr($iframe, $debutSrc, $length);

                    return $url;
                },
                function ($src) {
                    return $src;
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
