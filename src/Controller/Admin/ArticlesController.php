<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
* @Route("/admin/articles", name="admin_articles_")
* @package App\Controller\Admin
*/
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ArticlesRepository $articlesRepo): Response
    {
        return $this->render('admin/articles/index.html.twig', [
            'articles' => $articlesRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutArticles(Request $request)
    {
        
        $articles = new Articles;
        $form = $this->createForm(ArticlesType::class, $articles);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $articles->setUser($this->getUser());
            $em->persist($articles);
            $em->flush();

            return $this->redirectToRoute('admin_articles_index');

        }

        return $this->render('admin/articles/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifArticles(Articles $articles, Request $request)
    {
        $form = $this->createForm(ArticlesType::class, $articles);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articles);
            $em->flush();

            return $this->redirectToRoute('admin_articles_index');

        }

        return $this->render('admin/articles/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function supprimer(Articles $articles, Request $request)
    {
    
            $em = $this->getDoctrine()->getManager();
            $em->remove($articles);
            $em->flush();
            
            $this->addFlash('message', 'Article supprimé avec succès');

            return $this->redirectToRoute('admin_articles_index');
    }



}
