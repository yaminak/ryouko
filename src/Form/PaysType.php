<?php

namespace App\Form;

use App\Entity\Pays;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('drapeau', FileType::class, [
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
            ->add('population')
            ->add('paysage', FileType::class, [  
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
            ->add('description')
            ->add('superficie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pays::class,
        ]);
    }
}
