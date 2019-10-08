<?php

namespace App\Controller;

use App\Entity\ApiData;
use App\Form\ApiDataBackType;
use App\Form\ApiDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TtsController extends AbstractController
{
    /**
     * @Route("/{_locale}/tts")
     */
    public function index()
    {
        return $this->render('tts/index.html.twig', [

        ]);
    }

    /**
     * @Route("/{_locale}/tts/frontend")
     */
    public function ttsFront()
    {
        $apiData=new ApiData();
        $form=$this->createForm(ApiDataType::class,$apiData);

        return $this->render('tts/ttsFront.html.twig', [
            "form"=>$form->createView(),
        ]);
    }
    
    /**
     * @Route("/{_locale}/tts/backend")
     */
    public function ttsBack()
    {
        $apiData=new ApiData();
        $form=$this->createForm(ApiDataBackType::class,$apiData);

        return $this->render('tts/ttsBack.html.twig', [
            "form"=>$form->createView(),
        ]);
    }
}
