<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param Request $request
     * @return RedirectResponse
     * @Route("/")
     */
    public function redirectTTS(Request $request){
        return $this->redirectToRoute('app_home_index');
    }

    /**
     * @Route("/{_locale}/home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
