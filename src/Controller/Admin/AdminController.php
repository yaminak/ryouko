<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Categorie;
use App\Form\ArticlesType;
use App\Form\CategoriesType;
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
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
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
