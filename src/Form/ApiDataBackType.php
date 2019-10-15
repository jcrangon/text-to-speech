<?php

namespace App\Form;

use App\Entity\ApiData;
use App\Entity\IbmWatsonSpeechTtsApi;
use App\Entity\IbmWatsonTtsVoiceCatalog;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiDataBackType extends AbstractType
{
    private $api;
    private $apiVoiceCatalog;

    public function __construct(IbmWatsonSpeechTtsApi $api, IbmWatsonTtsVoiceCatalog $IbmVoiceCatalog)
    {
        $api=$api->autoConf('env');
        $this->api = $api;
        $this->apiVoiceCatalog = $IbmVoiceCatalog;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $IbmTtsVoiceCatalog=$this->apiVoiceCatalog->setVoiceList($this->api);

        $builder
            ->add('voice', ChoiceType::class,
                [
                    'choices' => $IbmTtsVoiceCatalog->getVoiceList(),
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
