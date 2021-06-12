<?php

namespace App\Form;

use App\Entity\Commune;
use App\Entity\Departement;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommuneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class,array(
                'label' => 'Commune :',
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
            ->add('departement', EntityType::class, array(
                'required' => false,
                'label' => 'Département:',
                'class' => Departement::class,
                'query_builder' => function (EntityRepository $jc) {
                    return $jc->createQueryBuilder('d')
                        ->orderBy('d.libelle', 'ASC');
                },
                'attr' => ['data-select' => 'true']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commune::class,
        ]);
    }
}
