<?php

namespace App\Form;

use App\Entity\Tontine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormTontineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meconomie',MoneyType::class,array(
                'label'     => 'Mise Journalière :',
                'required'  => false,
                'currency'  =>  'CFA',
                'attr'      =>[
                    'readonly'   =>  'readonly'
                ]
            ))
            ->add('numordre',TextType::class,array(
                'label'     => 'N° d\'ordre :',
                'required'  => false,
                'attr'      =>[
                    'readonly'   =>  'readonly'
                ]
            ))
            ->add('ranglivret',TextType::class,array(
                'label'     => 'N° Rang :',
                'required'  => false,
                'attr'      =>[
                    'readonly'   =>  'readonly'
                ]
            ))
            ->add('feuillet',TextType::class,array(
                'label'     => 'N° Feuillet :',
                'required'  => false,
                'attr'      =>[
                    'readonly'   =>  'readonly'
                ]
            ))
            ->add('appointrest',IntegerType::class,array(
                'label'     => 'Appointement restant :',
                'required'  => false,
                'attr'      =>[
                    'readonly'   =>  'readonly'
                ]
            ))
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tontine::class,
        ]);
    }
}
