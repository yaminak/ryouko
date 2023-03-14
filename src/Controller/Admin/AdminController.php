<?php

namespace App\Controller\Admin;

use App\Entity\Pays;
use App\Form\CommentaireType;
use App\Repository\ArticlesRepository;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
* @Route("/admin", name="admin_")
* @package App\Controller\Admin
*/
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CommentaireRepository $commentaireRepository, ArticlesRepository $articlesRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/categories/ajout", name="categories_ajout")
     */
    public function ajoutCategorie(Request $request)
    {

        $categorie = new Categorie;
        $form = $this->createForm(CategoriesType::class, $categorie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_home');

        }

        return $this->render('admin/categories/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/articles/ajout", name="articles_ajout")
     */
    public function ajoutArticles(Request $request)
    {
        $articles = new Articles;
        
        $form = $this->createForm(ArticlesType::class, $articles);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
                $articles->setUser($this->getUser());

                $em = $this->getDoctrine()->getManager();
                $em->persist($articles);
                $em->flush();

                return $this->redirectToRoute('admin_home');
        }
        
        return $this->render('admin/articles/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
