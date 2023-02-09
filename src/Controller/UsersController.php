<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="app_users")
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    /**
     * @Route("/users/annonces/ajout", name="users_annonces_ajout")
     */
    public function ajoutAnnonce(Request $request)
    {
        $annonce = new Annonces;
        
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
                $annonce->setUser($this->getUser());
                $annonce->setActive(false);

                $em = $this->getDoctrine()->getManager();
                $em->persist($annonce);
                $em->flush();

                return $this->redirectToRoute('app_users');
        }
        
        return $this->render('users/annonces/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
