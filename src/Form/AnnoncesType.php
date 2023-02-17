<?php

namespace App\Form;

<<<<<<< HEAD

use App\Entity\User;
=======
>>>>>>> b8b5664976d47d372577402203ebd783e53003ea
use App\Entity\Annonces;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
=======
>>>>>>> b8b5664976d47d372577402203ebd783e53003ea
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('content', CKEditorType::class)
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
