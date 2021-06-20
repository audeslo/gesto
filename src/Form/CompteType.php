<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Client;
use App\Entity\Compte;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class,array(
                'label'     =>  'Intitulé du compte :'
            ))
            ->add('type', ChoiceType::class,array(
                'label'     =>  'Type de compte :',
                'choices'   =>  array('Tontine' => '01','Epargne'  =>'02',
                                        'Courant'   => '03')
            ))
            ->add('datecompt', DateType::class,array(
                'label' => 'Date comptable :'
            ))
            ->add('client', EntityType::class, array(
                'required' => false,
                'label' => 'Client:',
                'class' => Client::class,
                'query_builder' => function (EntityRepository $jc) {
                    return $jc->createQueryBuilder('cl')
                        ->orderBy('cl.nom', 'ASC');
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
