<?php

namespace App\Controller;

use App\Repository\HobbiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(HobbiesRepository $hr): Response
    {
        $hobbies = $hr->findByCategorieField('home');
dd($hobbies);
        return $this->render('home/index.html.twig', [
            'hobbies' => $hobbies,
        ]);
    }
}
