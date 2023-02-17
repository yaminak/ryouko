<?php

namespace App\Controller;

use App\Entity\Categorie;
// use App\Model\SearchData;
use App\Repository\PhotosRepository;
use App\Repository\HobbiesRepository;
use App\Repository\AnnoncesRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(CategorieRepository $cr, Request $request, AnnoncesRepository $annoncesRepo): Response
    { 
        
        // $searchData = new SearchData();
        // $form = $this->createForm(SearchType::class, $searchData);
        // $form->handleRequest($request);

        // if($form->isSubmitted() && $form->isValid()) {
        //     dd($searchData);
        // }

        $annonces = $annoncesRepo->findAll();
        $categorie = $cr->findOneByCategorieField('home');

        return $this->render('home/index.html.twig', [
            // 'form' => $form->createView(),
            'annonces' => $annonces,
            'categorie' => $categorie,
        ]);
    }

}
