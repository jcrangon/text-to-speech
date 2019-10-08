<?php

namespace App\Form;

use App\Entity\ApiData;
use App\Entity\VoiceCatalog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $voiceCatalog=new VoiceCatalog();
        $builder
            ->add('voice', ChoiceType::class,
                [
                    'choices' => $voiceCatalog->getVoiceList(),
                ]
            )
            ->add('text', TextType::class, [])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ApiData::class,
        ]);
    }
}
