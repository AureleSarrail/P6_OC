<?php

namespace App\Form;

use App\Entity\Video;
use App\Form\DataTransformer\IframeToUrl;
use App\Validator\VideoIframe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddVideoFormType extends AbstractType
{
    private $transformer;

    public function __construct(IframeToUrl $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class, [
                'constraints' => [
                    new VideoIframe()
                ]
            ]);

        $builder->get('url')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
