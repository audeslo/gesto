<?php

namespace App\Form;

use App\Entity\Parametre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ParametreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('denomination',TextType::class,array(
                'label' => 'Dénomination :',
                'required' => true,
            ))
            ->add('adresse',TextType::class,array(
                'label' => 'Adresse :',
                'required' => false,
            ))
            ->add('telephone',TextType::class,array(
                'label' => 'Téléphone :',
                'required' => true,
            ))
            ->add('email',EmailType::class,array(
                'label' => 'E-mail :',
                'required' => false,
            ))
            ->add('ifu',TextType::class,array(
                'label' => 'IFU :',
                'required' => false,
            ))
            ->add('datecreation',BirthdayType::class,array(
                'label' => 'Date création :',
                'required' => true,
            ))
            ->add('rccm',TextType::class,array(
                'label' => 'RCCM :',
                'required' => false,
            ))
            ->add('ville',TextType::class,array(
                'label' => 'Ville :',
                'required' => false,
            ))
            ->add('devise',TextType::class,array(
                'label' => 'Devise :',
                'required' => false,
            ))
            ->add('actif',CheckboxType::class,array(
                'label' => 'Actif :',
                'required' => false,
            ))
            ->add('file',           FileType::class,array(
                'label'       =>  'Logo: ',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5120k',
                        /*'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Ajouter un fichier PDF Valide',*/
                    ])
                ]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parametre::class,
        ]);
    }
}
