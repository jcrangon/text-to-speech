<?php

namespace App\Controller;

use App\Entity\ApiData;
use App\Entity\IbmWatsonSpeechTtsApi;
use App\Entity\IbmWatsonTtsAudioFetcher;
use App\Entity\TempFileCleaner;
use App\Form\ApiDataBackType;
use App\Form\ApiDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TtsController extends AbstractController
{
    /**
     * @Route("/{_locale}/tts")
     * @param TempFileCleaner $tempFileCleaner
     * @return Response
     */
    public function index(TempFileCleaner $tempFileCleaner)
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
     * @throws TransportExceptionInterface
     */
    public function ttsBack(Request $request)
    {
        $showPlayer=false;
        $playerSrc="";

        $apiData=new ApiData();
        $form=$this->createForm(ApiDataBackType::class, $apiData);

        // on handle le form
        //si valid on cree un objet  watsonTtsApi
        //puis on cree un objet audioFetcher à qui on passe l'objet api
        //puis on recupere la propriété filename que l'on refile à $playerSrc

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $apiData = $form->getData();
            $options=array(
                'selectedVoice' => $apiData->getVoice(),
                'text' => $apiData->getText(),
                'projectDir' => $_SERVER['PROJECT_DIR'],
            );
            $ttsApi = new IbmWatsonSpeechTtsApi();
            $ttsApi->autoConf('env');
            $audioFetcher = new IbmWatsonTtsAudioFetcher();
            $audioFetcher->fetchAudio($ttsApi,$options);
            $showPlayer=true;
            $playerSrc=$audioFetcher->getFilename();
        }



        return $this->render('tts/ttsBack.html.twig', [
            "form"=>$form->createView(),
            'showPlayer' => $showPlayer,
            'playerSrc' => $playerSrc,
        ]);
    }

}
