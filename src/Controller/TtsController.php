<?php

namespace App\Controller;

use App\Entity\ApiData;
use App\Form\ApiDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TtsController extends AbstractController
{
    /**
     * @Route("/tts")
     */
    public function index()
    {
        return $this->render('tts/index.html.twig', [

        ]);
    }

    /**
     * @Route("/tts/frontend")
     */
    public function ttsFront()
    {
        $apiData=new ApiData();
        $form=$this->createForm(ApiDataType::class,$apiData);

        return $this->render('tts/ttsFront.html.twig', [
            "form"=>$form->createView(),
        ]);
    }
}
