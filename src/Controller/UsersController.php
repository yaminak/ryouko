<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Form\EditProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index()
    {
        return $this->render('users/index.html.twig');
    }

    /**
     * @Route("/users/articles/ajout", name="users_articles_ajout")
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

                return $this->redirectToRoute('users');
        }
        
        return $this->render('users/articles/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/users/profil/modifier", name="users_profil_modifier")
     */
    public function editProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $this->addFlash('message', 'Profil mis à jour');
                return $this->redirectToRoute('users');
        }
        
        return $this->render('users/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/users/password/modifier", name="users_password_modifier")
     */
    public function editPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            //on vérifie si les 2 mots de passe sont identiques
            if($request->request->get('pass') == $request->request->get('pass2')) {

                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');
                return $this->redirectToRoute('users');

            }else{
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
            }
        }
        
        return $this->render('users/editpassword.html.twig');
    }
    
}
