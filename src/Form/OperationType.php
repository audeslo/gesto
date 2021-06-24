<?php

namespace App\Form;

use App\Entity\Operation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('numop')*/
            ->add('numop',IntegerType::class,array(
                'label'     => 'Numéro opération :',
                'required'  => false
            ))
            ->add('numpiece',IntegerType::class,array(
        'label'     => 'Numéro de la pièce :',
        'required'  => false
    ))
            ->add('dateop',DateType::class,array(
        'label'     => 'Date opération :',
        'required'  => false
    ))
            ->add('libelleop',TextType::class,array(
        'label'     => 'Libellé opération :',
        'required'  => false,
        'attr'      =>[
            'oninput'   =>  'premiereLettreMajuscule(this)'
        ]
    ))

            ->add('refpiece',IntegerType::class,array(
        'label'     => 'Référence de la pièce :',
        'required'  => false
    ))

            ->add('montantop',IntegerType::class,array(
        'label'     => 'Montant de l opération :',
        'required'  => false
    ))
            ->add('genere')
            ->add('valide')
            ->add('datecomptabilisation',DateType::class,array(
                'label'     => 'Date de la comptabilisation :',
                'required'  => false
            ))
           /* ->add('createdOn')
            ->add('editedOn')
            ->add('slug')*/
            ->add('agence')
           /* ->add('createdBy')
            ->add('editedBy')*/
            ->add('client')
          /*  ->add('tontine')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Operation::class,
        ]);
    }
}
