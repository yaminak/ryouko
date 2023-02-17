<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Form\CategoriesType;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
* @Route("/admin/categorie", name="admin_categorie_")
* @package App\Controller\Admin
*/
class CategorieController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategorieRepository $catRepo): Response
    {
        return $this->render('admin/categorie/index.html.twig', [
            'categories' => $catRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
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

            return $this->redirectToRoute('admin_categorie_home');

        }

        return $this->render('admin/categorie/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifCategorie(Categorie $categorie, Request $request)
    {
        $form = $this->createForm(CategoriesType::class, $categorie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categorie_home');

        }

        return $this->render('admin/categorie/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
