<?php

namespace App\Form;

use App\Entity\Tontine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TontineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meconomie')
            ->add('numordre')
            ->add('dateinscr')
            ->add('numlivret')
            ->add('nbmois')
            ->add('numton')
            ->add('mcredit')
            ->add('remboursement')
            ->add('avance')
            ->add('interet')
            ->add('feuillet')
            ->add('finfeuillet')
            ->add('numcreditencours')
            ->add('nbmaxappoint')
            ->add('dateraappoint')
            ->add('slug')
            ->add('createdOn')
            ->add('editedOn')
            ->add('createdBy')
            ->add('editedBy')
            ->add('client')
            ->add('agence')
            ->add('compte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tontine::class,
        ]);
    }
}
