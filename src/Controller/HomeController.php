<?php

namespace App\Controller;

use App\Entity\Categorie;
// use App\Model\SearchData;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Repository\PhotosRepository;
use App\Repository\HobbiesRepository;
use App\Repository\AnnoncesRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(CategorieRepository $cr, Request $request, AnnoncesRepository $annoncesRepo,  MailerInterface $mailer): Response
    { 
        
        // $searchData = new SearchData();
        // $form = $this->createForm(SearchType::class, $searchData);
        // $form->handleRequest($request);

        // if($form->isSubmitted() && $form->isValid()) {
        //     dd($searchData);
        // }

        $annonces = $annoncesRepo->findAll();
        $categorie = $cr->findOneByCategorieField('home');

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $adresse = $data['email'];
            $contenu = $data['content'];


            $email = (new Email())
            ->from($adresse)
            ->to(new Address('myaddress@yahoo.fr', 'my address email'))
            ->subject('Demande de contact')
            ->text($contenu);

            $mailer->send($email);

            $this->addFlash('success', 'Your email was sent successfully');

            return $this->redirectToRoute('app_home');
  
    };

    return $this->render('home/index.html.twig', [
        // 'form' => $form->createView(),
        'annonces' => $annonces,
        'categorie' => $categorie,
        'formulaire' => $form->createView(),
        ]);
    }

}
