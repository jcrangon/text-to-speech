<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SttController extends AbstractController
{
    /**
     * @Route("/stt")
     */
    public function index()
    {
        return $this->render('stt/index.html.twig', [
            'controller_name' => 'SttController',
        ]);
    }
}
