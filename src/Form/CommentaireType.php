<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\User;
use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
                ])
            ->add('pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'nom',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
