<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LikesController extends AbstractController
{
    // private $entityManager;

    // public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator)
    // {
    //     $this->entityManager = $entityManager;
    //     $this->urlGnerator = $urlGenerator;
    // }
    /**
     * @Route("/likes/{id}", name="app_likes")
     */
    public function index(): Response
    {
        // $leCommentaire = $this->entityManager->getRepository(Commentaire::class)->findOneById($id);
        // $entityManager = $doctrine->getManager();

        // $likes = $leCommentaire->getLikes();

        // $plusDeLikes = $likes + 1;

        // $leCommentaire->setLikes($plusDeLikes);
        // $entityManager->flush();

        return $this->redirectToRoute('likes/index.html.twig', [
            'controller_name' => 'LikesController',
        ]);
    }
}
