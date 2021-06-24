<?php

namespace App\Form;

use App\Entity\Operation;
use App\Entity\Tontine;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationTontineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('nomcomplet',TextType::class,array(
                'label' => 'Client :',
                'required' => false,
                'attr'      =>[
                   'readonly'   =>  'readonly'
                ]
            ))
            ->add('montantop',MoneyType::class,array(
                'label'     => 'Montant Opération :',
                'required'  => false,
                'currency'  =>  'CFA'
            ))
            ->add('operant',TextType::class,array(
                'label' => 'Déposant(e) :',
                'required' => false,

            ))
            ->add('dateop',DateTimeType::class,array(
                'label' => 'Date/heure Opération.',
                'required' => false,

            ))
            ->add('note',TextareaType::class,array(
                'label' => 'Note :',
                'required' => false,

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Operation::class,
        ]);
    }
}
