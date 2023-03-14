<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
     /**
     * @Route("/", name="app_articles_index", methods={"GET"})
     */
    public function index(ArticlesRepository $articlesRepo): Response
    {

        $articles = $articlesRepo->findAll();

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/recherche", name="app_articles_recherche", methods={"GET"})
     */
    public function recherche(Request $request, ArticlesRepository $articlesRepository, CommentaireRepository $cr): Response
    {
        $tag = $request->query->get('search');
        $searchArticles = $articlesRepository->searchArticlesByTag($tag);
        $searchCom = $cr->searchCommentsByTag($tag);
        // dd($searchAnnonce, $searchCom);
        return $this->render('articles/recherche.html.twig', [
            'articles' => $searchArticles,
            'commentaires'=> $searchCom,
        ]);
    }

    
}