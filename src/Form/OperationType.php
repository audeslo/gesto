<?php

namespace App\Form;

use App\Entity\Operation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numop')
            ->add('numpiece')
            ->add('dateop')
            ->add('libelleop')
            ->add('refpiece')
            ->add('montantop')
            ->add('genere')
            ->add('valide')
            ->add('datecomptabilisation')
            ->add('createdOn')
            ->add('editedOn')
            ->add('slug')
            ->add('agence')
            ->add('createdBy')
            ->add('editedBy')
            ->add('client')
            ->add('tontine')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Operation::class,
        ]);
    }
}
