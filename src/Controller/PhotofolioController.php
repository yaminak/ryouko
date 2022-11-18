<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhotofolioController extends AbstractController
{
    /**
     * @Route("/photofolio", name="app_photofolio")
     */
    public function index(): Response
    {
        return $this->render('photofolio/index.html.twig', [
            'controller_name' => 'PhotofolioController',
        ]);
    }
}
