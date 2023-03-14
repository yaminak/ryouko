<?php

namespace App\Controller;

use App\Entity\ComLike;
use App\Entity\ComDislike;
use App\Entity\Commentaire;
// use Doctrine\Persistence\ObjectManager;
use App\Form\CommentaireType;
use App\Repository\ComLikeRepository;
use App\Repository\ComDislikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/commentaire")
 */
class CommentaireController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="app_commentaire_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Commentaire $commentaire, CommentaireRepository $commentaireRepository): Response
    {
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireRepository->add($commentaire, true);

            return $this->redirectToRoute('app_pays_show', ['id' => $commentaire->getPays()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire/edit.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_commentaire_delete", methods={"POST"})
     */
    public function delete(Request $request, Commentaire $commentaire, CommentaireRepository $commentaireRepository): Response
    {

        if ($this->isCsrfTokenValid('delete'.$commentaire->getId(), $request->request->get('_token'))) {
            $commentaireRepository->remove($commentaire, true);
        }

        return $this->redirectToRoute('app_pays_show', ['id' => $commentaire->getPays()->getId()], Response::HTTP_SEE_OTHER);
    }

    
    // Permet de liker ou unliker un commentaire

     /**
     * @Route("/{id}/like", name="app_commentaire_like")
     */
    public function like(Commentaire $commentaire, EntityManagerInterface $manager, ComLikeRepository $likeRepo) : Response
     {
         $user = $this ->getUser();

         if(!$user) return $this->json([
             'code'  => 403,
             'message' => "Unauthorized"
         ], 403);

         if($commentaire->isLikedByUser($user)) {
             $like = $likeRepo->findOneBy([
                 'commentaire' => $commentaire,
                 'user'        => $user

             ]);

             $manager->remove($like);
             $manager->flush();

             return $this->json([
                 'code'=> 200, 
                 'message' => 'like bien supprimé',
                 'likes'=> $likeRepo->count(['commentaire' => $commentaire]) 
                ], 200);
         }

         $like = new ComLike();
         $like->setCommentaire($commentaire)
              ->setUser($user);
            
        $manager->persist($like);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'message' => 'Like bien ajouté',
            'likes'=> $likeRepo->count(['commentaire' => $commentaire]) 
        ], 200);
    }

    // Permet de disliker ou undisliker un commentaire

     /**
     * @Route("/{id}/dislike", name="app_commentaire_dislike")
     */
    // public function dislike(Commentaire $commentaire, EntityManagerInterface $manager, ComDislikeRepository $dislikeRepo) : Response
    //  {
    //      $user = $this ->getUser();

    //      if(!$user) return $this->json([
    //          'code'  => 403,
    //          'message' => "Unauthorized"
    //      ], 403);

    //      if($commentaire->isDislikedByUser($user)) {
    //          $dislike = $dislikeRepo->findOneBy([
    //              'commentaire' => $commentaire,
    //              'user'        => $user

    //          ]);

    //          $manager->remove($dislike);
    //          $manager->flush();

    //          return $this->json([
    //              'code'=> 200, 
    //              'message' => 'le dislike a bien été supprimé',
    //              'likes'=> $dislikeRepo->count(['commentaire' => $commentaire]) 
    //             ], 200);
    //      }

    //      $dislike = new ComDislike();
    //      $dislike->setCommentaire($commentaire)
    //              ->setUser($user);
            
    //     $manager->persist($dislike);
    //     $manager->flush();

    //     return $this->json([
    //         'code'=> 200,
    //         'message' => 'le dislike bien été ajouté',
    //         'dislikes'=> $dislikeRepo->count(['commentaire' => $commentaire]) 
    //     ], 200);
    // }


}
