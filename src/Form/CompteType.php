<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Client;
use App\Entity\Compte;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numcomp')
            ->add('intitule')
            ->add('cpcmd')
            ->add('cpcmc')
            ->add('cpasld')
            ->add('cpasldj')
            ->add('cpnbmvt')
            ->add('cpdtder')
            ->add('mdate')
            ->add('mheure')
            ->add('annexo')
            /* ->add('editedOn')
             ->add('createdOn')*/
            /*->add('slug')*/
            /*  ->add('agence')*/
            ->add('agence', EntityType::class, array(
                'required' => false,
                'label' => 'Agence:',
                'class' => Agence::class,
                'query_builder' => function (EntityRepository $jc) {
                    return $jc->createQueryBuilder('d')
                        ->orderBy('d.libelle', 'ASC');
                },
                'attr' => ['data-select' => 'true']
            ))

            ->add('client', EntityType::class, array(
                'required' => false,
                'label' => 'Client:',
                'class' => Client::class,
                'query_builder' => function (EntityRepository $jc) {
                    return $jc->createQueryBuilder('d')
                        ->orderBy('d.nom', 'ASC');
                },
                'attr' => ['data-select' => 'true']
            ))
            /* ->add('editedBy')
             ->add('createdBy')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
