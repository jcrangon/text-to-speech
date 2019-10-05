<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class TtsController extends AbstractController
{
    /**
     * @Route("/tts")
     */
    public function index()
    {
        return $this->render('tts/index.html.twig', [
            'controller_name' => 'TtsController',
        ]);
    }
}
