<?php

namespace App\Form;

use App\Entity\Collecte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollecteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleclt')
            ->add('montantclt')
            ->add('dateclt')
            ->add('createdOn')
            ->add('editedOn')
            ->add('slug')
            ->add('tontine')
            ->add('operation')
            ->add('agence')
            ->add('createdBy')
            ->add('editedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collecte::class,
        ]);
    }
}
