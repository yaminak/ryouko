<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/annonces")
 */
class AnnoncesController extends AbstractController
{
     /**
     * @Route("/", name="app_annonces_index", methods={"GET"})
     */
    public function index(AnnoncesRepository $annoncesRepo): Response
    {

        $annonces = $annoncesRepo->findAll();

        return $this->render('annonces/index.html.twig', [
            'annonces' => $annonces,
        ]);
    }

    /**
     * @Route("/recherche", name="app_annonces_recherche", methods={"GET"})
     */
    public function recherche(Request $request, AnnoncesRepository $annoncesRepository, CommentaireRepository $cr): Response
    {
        $tag = $request->query->get('search');
        $searchAnnonce = $annoncesRepository->searchAnnoncesByTag($tag);
        $searchCom = $cr->searchCommentsByTag($tag);
        // dd($searchAnnonce, $searchCom);
        return $this->render('annonces/recherche.html.twig', [
            'annonces' => $searchAnnonce,
            'commentaires'=> $searchCom,
        ]);
    }

    
}