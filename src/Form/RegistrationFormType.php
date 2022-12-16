<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => ' ',
            ])
            ->add('email', TextType::class, [
                'label' => ' ',
            ])
            ->add('nom', TextType::class, [
                'label' => ' ',
            ])
            ->add('prenom', TextType::class, [
                'label' => ' ',
            ])
            ->add('civilite', ChoiceType::class, [
                'label' => ' ',
                // 'mapped' => false,
                'choices'  => [
                    'Madame' => "madame",
                    'Monsieur' => "monsieur",                   
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => ' ',
            ])
            ->add('codePostal', TextType::class, [
                'label' => ' ',
            ])
            ->add('ville', TextType::class, [
                'label' => ' ',
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Choose an avatar',
                'mapped' => false,
                "constraints" => [
                    new File([
                        "mimeTypes"         => [ "image/gif", "image/jpeg", "image/png" ],
                        "mimeTypesMessage"  => "Les formats autorisés sont gif, jpg, png",
                        "maxSize"           => "1024k",
                        "maxSizeMessage"    => "Le fichier ne peut pas peser plus de 2Mo"
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => ' ',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
