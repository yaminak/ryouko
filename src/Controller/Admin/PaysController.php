<?php

namespace App\Controller\Admin;

use App\Entity\Pays;
use App\Entity\User;
use App\Form\PaysType;
use App\Entity\Articles;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\PaysRepository;
use App\Repository\HobbiesRepository;
use App\Repository\ArticlesRepository;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/pays")
 * @package App\Controller\Admin
 */
class PaysController extends AbstractController
{
    /**
     * @Route("/", name="admin_pays_index", methods={"GET"})
     */
    public function index(PaysRepository $paysRepository): Response
    {
        return $this->render('admin/pays/index.html.twig', [
            'pays' => $paysRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_pays_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PaysRepository $paysRepository): Response
    {
        $pay = new Pays();
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichierDrapeau = $form->get("drapeau")->getData();
            $fichier = $form->get("paysage")->getData();
            if( $fichierDrapeau ){
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
                $fichierDrapeau->move("images", $nomFichier);

                $pay->setDrapeau($nomFichier);
            }
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

                $pay->setPaysage($nomFichier);
            }
            $paysRepository->add($pay, true);

            return $this->redirectToRoute('admin_pays_index', [], Response::HTTP_SEE_OTHER);
        }

            return $this->renderForm('admin/pays/new.html.twig', [
            'pay' => $pay,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_pays_show", methods={"GET"})
     */
    public function show(Request $request, Pays $pay, PaysRepository $paysRepository, CommentaireRepository $commentaireRepository, ArticlesRepository $articlesRepo): Response
    
        {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);

        // $lastAnnonce = $articlesRepo->findOneBy([],array('id'=>'DESC'),1);
        $articles = $articlesRepo->findAll();
        return $this->renderForm('admin/pays/show.html.twig', [
            'pay' => $pay,
            'articles' => $articles,
            'formCommentaire' => $form,
        ]);
        
    
    }

    /**
     * @Route("/{id}/edit", name="admin_pays_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pays $pay, PaysRepository $paysRepository): Response
    {
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                if( $fichierDrapeau = $form->get("drapeau")->getData() ){
                    $nomFichier = pathinfo($fichierDrapeau->getClientOriginalName(), PATHINFO_FILENAME);
                    $slugger = new AsciiSlugger();
                    $nomFichier = $slugger->slug($nomFichier);
                    $nomFichier .= "_" . uniqid();
                    $nomFichier .= "." . $fichierDrapeau->guessExtension();
                    $fichierDrapeau->move("images", $nomFichier);
    
                    if( $pay->getDrapeau() ){
                        $fichierDrapeau = $this->getParameter("image_directory") . $pay->getDrapeau();
                        if( file_exists($fichierDrapeau) ){
                            unlink($fichierDrapeau);
                        } 
                     }                    
                    $pay->setDrapeau($nomFichier);
                }
                if( $fichier = $form->get("paysage")->getData() ){
                    $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $slugger = new AsciiSlugger();
                    $nomFichier = $slugger->slug($nomFichier);
                    $nomFichier .= "_" . uniqid();
                    $nomFichier .= "." . $fichier->guessExtension();
                    $fichier->move("images", $nomFichier);
    
                    if( $pay->getPaysage() ){
                        $fichier = $this->getParameter("image_directory") . $pay->getPaysage();
                        if( file_exists($fichier) ){
                            unlink($fichier);
                        } 
                     }                    
                    $pay->setPaysage($nomFichier);
            }
            $paysRepository->add($pay, true);

            return $this->redirectToRoute('admin_pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pays/edit.html.twig', [
            'pay' => $pay,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_pays_delete", methods={"POST"})
     */
    public function delete(Request $request, Pays $pay, PaysRepository $paysRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pay->getId(), $request->request->get('_token'))) {
            $paysRepository->remove($pay, true);
        }

        return $this->redirectToRoute('admin_pays_index', [], Response::HTTP_SEE_OTHER);
    }
}
