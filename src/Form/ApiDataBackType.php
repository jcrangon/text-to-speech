<?php

namespace App\Form;

use App\Entity\ApiData;
use App\Entity\VoiceCatalog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiDataBackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $voiceCatalog=new VoiceCatalog();

        $builder
            ->add('voice', ChoiceType::class,
                [
                    'choices' => $voiceCatalog->getVoiceList(),
                    'label' => false,
                    'attr' =>
                        [
                            'class' => 'formSelect',
                        ],
                ])
            ->add('text', TextareaType::class,
                [
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
