<?php

namespace App\Form;

use App\Entity\Categorie;
<<<<<<< HEAD
use App\Form\CategoriesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
=======
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
>>>>>>> b8b5664976d47d372577402203ebd783e53003ea
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
<<<<<<< HEAD
            ->add('intitule')
            ->add('categorie')
            ->add('parent')
            ->add('description')
=======
            ->add('intitule', TextType::class)
            // ->add('parent')
            ->add('categorie')
>>>>>>> b8b5664976d47d372577402203ebd783e53003ea
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
