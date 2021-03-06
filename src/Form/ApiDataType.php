<?php

namespace App\Form;

use App\Entity\ApiData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voice', ChoiceType::class,
                [
                    'choices' => [],
                    'label' => false,
                    'attr' =>
                        [
                            'class' => 'formSelect',
                        ],
                ])
            ->add('text', TextareaType::class,
                [
                    'label' => 'Text',
                    'attr' =>
                        [
                            'class' => 'formTextarea',
                            'placeholder' => 'Enter your text here',
                        ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ApiData::class,
        ]);
    }
}
