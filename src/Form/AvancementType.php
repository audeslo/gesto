<?php

namespace App\Form;

use App\Entity\Avancement;
use App\Entity\Tontine;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvancementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            /*->add('montantavan',MoneyType::class,array(
                'label'     => 'Montant avancement :',
                'required'  => false,
            ))
            ->add('soldecomp',MoneyType::class,array(
                'label'     => 'Solde Actuel :',
                'required'  => false,
            ))

            ->add('dateavan',DateTimeType::class,array(
                'label' => 'Date/heure Avancement.',
                'required' => false,

            ))*/

            ->add('tontine', EntityType::class, array(
                'required' => false,
                'label' => 'Référence (N°) Livret:',
                'class' => Tontine::class,
                'query_builder' => function (EntityRepository $jc) {
                    return $jc->createQueryBuilder('t')
                        ->where('t.niveau =:val')
                        ->setParameter('val','progress')
                        ->orderBy('t.reflivret', 'ASC');
                },
                'attr' => [
                    'data-select' => 'true',
                    'onchange'      => 'remplirChamps()'
                ]
            ))

            ->add('plafond',TextType::class,array(
                'label'     => 'Plafond :',
                'required'  => false,
                'mapped'    =>false,
                'attr'      =>[
                    'readonly'   =>  'readonly'
                ]
            ))
            ->add('temoinplafond',IntegerType::class,array(
                'mapped'    =>false,
                'attr'      =>[
                    'readonly'   =>  'readonly'
                ]
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Avancement::class,
        ]);
    }
}
