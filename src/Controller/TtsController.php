<?php

namespace App\Controller;

use App\Entity\ApiData;
use App\Entity\VoiceCatalog;
use App\Form\ApiDataBackType;
use App\Form\ApiDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @param Request $request
     * @return Response
     */
    public function ttsBack(Request $request)
    {
        $apiData=new ApiData();
        $form=$this->createForm(ApiDataBackType::class,$apiData);

        $showPlayer=false;
        $playerSrc="";

        return $this->render('tts/ttsBack.html.twig', [
            "form"=>$form->createView(),
            'showPlayer' => $showPlayer,
            'playerSrc' => $playerSrc,
        ]);
    }
}
