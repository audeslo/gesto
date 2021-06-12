<?php

namespace App\Form;

use App\Entity\Departement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class,array(
                'label' => 'Département :',
                'required' => false,
                'attr'      =>[
                    'oninput'   =>  'premiereLettreMajuscule(this)'
                ]
            ))
            ->add('description',TextareaType::class,array(
                'label' => 'Description :',
                'required' => false,
            ))
            ->add('actif', CheckboxType::class, array(
                'label'       =>    'Actif',
                'required'  => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Departement::class,
        ]);
    }
}
