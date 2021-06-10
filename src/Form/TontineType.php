<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Tontine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TontineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('toncliunik')
            ->add('nlivr')
            ->add('nordre')
            ->add('feuillet')
            ->add('finfeuillet')
            ->add('meconomie')
            ->add('dateins')
            ->add('agence', EntityType::class, [
                'class' => Agence::class,
                'choice_label'  => 'libelle',
                'label'         =>  'Agence :',
                'required'      => false,
                'placeholder'   => 'Sélectionnez lagence',
            ])
            ->add('client')
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label'  => 'nom',
                'label'         =>  'Client :',
                'required'      => false,
                'placeholder'   => 'Sélectionnez un client',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tontine::class,
        ]);
    }
}
