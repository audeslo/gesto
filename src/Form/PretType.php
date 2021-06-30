<?php

namespace App\Form;

use App\Entity\Pret;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libellepret',TextType::class,array(
                'label'     => 'Libellé de prêt :',
                'required'  => false,
                'attr'      =>[
                    'oninput'   =>  'premiereLettreMajuscule(this)'
                ]
            ))

            ->add('datepret',DateType::class,array(
                'label'     => 'Date de prêt:',
                'required'  => false
            ))

           /* ->add('slug')
            ->add('editedOn')
            ->add('createdOn')*/
            ->add('client')
            ->add('agence')
           /* ->add('agent')
            ->add('createdBy')
            ->add('editedBy')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pret::class,
        ]);
    }
}
