<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SttController extends AbstractController
{
    /**
     * @Route("/{_locale}/stt")
     */
    public function index()
    {
        return $this->render('stt/index.html.twig', [

        ]);
    }

    /**
     * @Route("/{_locale}/stt/frontend")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sttFront(Request $request)
    {


        $locale=$request->getLocale();
        return $this->render('stt/sttFront.html.twig', [
            'locale' => $locale,
        ]);
    }

    /**
     * @Route("/{_locale}/stt/backend")
     */
    public function sttBack()
    {
        $locale=$request->getLocale();
        return $this->render('stt/sttBack.html.twig', [
            'locale' => $locale,
        ]);
    }
}
