<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\HobbiesRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(CategorieRepository $cr): Response
    {
        $categorie = $cr->findOneByCategorieField('home');
        return $this->render('home/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }
}
