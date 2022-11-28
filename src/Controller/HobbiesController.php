<?php

namespace App\Controller;

use App\Entity\Hobbies;
use App\Form\HobbiesType;
use App\Repository\HobbiesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/hobbies")
 */
class HobbiesController extends AbstractController
{
    /**
     * @Route("/", name="app_hobbies_index", methods={"GET"})
     */
    public function index(HobbiesRepository $hobbiesRepository): Response
    {
        return $this->render('hobbies/index.html.twig', [
            'hobbies' => $hobbiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_hobbies_new", methods={"GET", "POST"})
     */
    public function new(Request $request, HobbiesRepository $hobbiesRepository): Response
    {
        $hobby = new Hobbies();
        $form = $this->createForm(HobbiesType::class, $hobby);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier = $form->get("photo")->getData();
            if( $fichier ){
                // on récupère le nom du fichier 
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                // La classe AsciiSlugger va remplacer les caractères spéciaux par des caractères autorisés dans les URL
                $slugger = new AsciiSlugger();
                $nomFichier = $slugger->slug($nomFichier);
                // La fonction PHP 'uniquid' va générer un string unique sur le serveur
                $nomFichier .= "_" . uniqid();
                // on rajoute l'extension du nom de fichier original
                $nomFichier .= "." . $fichier->guessExtension();
                // on copie le fichier dans le dossier public/images avec le nouveau nom de fichier 
                $fichier->move("images", $nomFichier);

                $hobby->setPhoto($nomFichier);
            }
        
            $hobbiesRepository->add($hobby, true);

            return $this->redirectToRoute('app_hobbies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hobbies/new.html.twig', [
            'hobby' => $hobby,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hobbies_show", methods={"GET"})
     */
    public function show(Hobbies $hobby): Response
    {
        return $this->render('hobbies/show.html.twig', [
            'hobby' => $hobby,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_hobbies_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Hobbies $hobby, HobbiesRepository $hobbiesRepository): Response
    {
        $form = $this->createForm(HobbiesType::class, $hobby);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if( $fichier = $form->get("photo")->getData() ){
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $slugger = new AsciiSlugger();
                $nomFichier = $slugger->slug($nomFichier);
                $nomFichier .= "_" . uniqid();
                $nomFichier .= "." . $fichier->guessExtension();
                $fichier->move("images", $nomFichier);

                if( $hobby->getPhoto() ){
                    $fichier = $this->getParameter("image_directory") . $hobby->getPhoto();
                    if( file_exists($fichier) ){
                        unlink($fichier);
                    } 
                 }                    
                $hobby->setPhoto($nomFichier);
        
                $hobbiesRepository->add($hobby, true);
            return $this->redirectToRoute('app_hobbies_index', [], Response::HTTP_SEE_OTHER);
        }
}
        return $this->renderForm('hobbies/edit.html.twig', [
            'hobby' => $hobby,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_hobbies_delete", methods={"POST"})
     */
    public function delete(Request $request, Hobbies $hobby, HobbiesRepository $hobbiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hobby->getId(), $request->request->get('_token'))) {
            $hobbiesRepository->remove($hobby, true);
        }

        return $this->redirectToRoute('app_hobbies_index', [], Response::HTTP_SEE_OTHER);
    }
}
