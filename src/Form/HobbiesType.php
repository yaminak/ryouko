<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Pays;
use App\Entity\Hobbies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class HobbiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('loisir')
            ->add('pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'nom',
                ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'categorie',
                ])
            ->add('photo', FileType::class, [
                "mapped" => false,
                "required" => false,
                "constraints" => [
                    new File([
                        "mimeTypes"         => [ "image/gif", "image/jpeg", "image/png" ],
                        "mimeTypesMessage"  => "Les formats autorisés sont gif, jpg, png",
                        "maxSize"           => "2048k",
                        "maxSizeMessage"    => "Le fichier ne peut pas peser plus de 2Mo"
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hobbies::class,
        ]);
    }
}
