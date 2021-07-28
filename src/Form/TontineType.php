<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Compte;
use App\Entity\Tontine;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TontineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client',TextType::class,array(
                'label'     => 'Client :',
                'required'  => false,
                'mapped'    => false,
                'attr' => ['readonly' => 'readonly']
            ))
            ->add('compte',TextType::class,array(
                'label'     => 'N° Compte :',
                'required'  => false,
                'mapped'    => false,
                'attr' => ['readonly' => 'readonly']
            ))
            ->add('meconomie',NumberType::class,array(
                        'label'     => 'Montant Economie :',
                        'required'  => false
                    ))
                    ->add('ranglivret',IntegerType::class,array(
                        'label'     => 'Rang livret :',
                        'required'  => false
                    ))
                    ->add('reflivret',TextType::class,array(
                        'label'     => 'Référence du livret :',
                        'required'  => false
                    ))
                    ->add('nbfeuillet',NumberType::class,array(
                        'label'     => 'Nombre de feuillets :',
                        'required'  => false
                    ))
                    ->add('nbmaxappoint',ChoiceType::class,array(
                        'choices'   => array(31 =>31,30 => 30),
                        'label'     => 'Appointement Maxi /feuillet :',
                        'required'  => false
                    ))
                    ->add('dateinscr',DateType::class,array(
                        'label'     => 'Date de souscription :',
                        'required'  => false
                    ))
                    ->add('note',TextareaType::class,array(
                        'label'     => 'Note :',
                        'required'  => false
                    ))
                    ->add('actif',CheckboxType::class,array(
                        'label'     => 'Actif :',
                        'required'  => false
                    ))
            ;
//        $builder
//            ->add('client', EntityType::class, array(
//                'required' => false,
//                'label' => 'Client :*',
//                'class' => Client::class,
//                'query_builder' => function (EntityRepository $entityRepository) {
//                    return $entityRepository->createQueryBuilder('clt')
//                        ->select('clt')
//                        ->andWhere('clt.actif=?1')
//                        ->setParameter(1,true)
//                        ->orderBy('clt.nom', 'ASC')
//                        ->addOrderBy('clt.prenoms', 'ASC');
//                },
//                'attr' => ['data-select' => 'true']
//            ));
//
//
//        $builder->get('client')->addEventListener(
//            FormEvents::POST_SUBMIT,
//            function (FormEvent $event) {
//                $form = $event->getForm();
//                $form->getParent()
//                    ->add('compte', EntityType::class, array(
//                        'label' => 'N° Compte :*',
//                        'class' => Compte::class,
//                        'choices' => $form->getData() ? $form->getData()->getComptes() : [],
//                        'required' => false,
//                        'attr' => [
//                            'data-select' => 'true'
//                        ]
//                    ))
//                    ->add('meconomie',NumberType::class,array(
//                        'label'     => 'Montant Economie :',
//                        'required'  => false
//                    ))
//                    ->add('ranglivret',IntegerType::class,array(
//                        'label'     => 'Rang livret :',
//                        'required'  => false
//                    ))
//                    ->add('reflivret',TextType::class,array(
//                        'label'     => 'Référence du livret :',
//                        'required'  => false
//                    ))
//                    ->add('nbfeuillet',NumberType::class,array(
//                        'label'     => 'Nombre de feuillets :',
//                        'required'  => false
//                    ))
//                    ->add('nbmaxappoint',ChoiceType::class,array(
//                        'choices'   => array(31 =>31,30 => 30),
//                        'label'     => 'Appointement Maxi /feuillet :',
//                        'required'  => false
//                    ))
//                    ->add('dateinscr',DateType::class,array(
//                        'label'     => 'Date de souscription :',
//                        'required'  => false
//                    ))
//                    ->add('note',TextareaType::class,array(
//                        'label'     => 'Note :',
//                        'required'  => false
//                    ))
//                    ->add('actif',CheckboxType::class,array(
//                        'label'     => 'Actif :',
//                        'required'  => false
//                    ))
//                ;
//            }
//        );
//
//        $builder->addEventListener(
//            FormEvents::POST_SET_DATA,
//            function (FormEvent $event) {
//                $data = $event->getData();
////                /* @var $poste Poste*/
//                $client = $data->getclient();
//                if ($client) {
//                    $form = $event->getForm();
//                    $form
//                        ->add('compte', EntityType::class, array(
//                            'label' => 'Compte : *',
//                            'class' => Compte::class,
//                            'choices' => $client ? $client->getComptes() : [],
//                            'required' => false,
//                            'attr' => [
//                                'data-select' => 'true'
//                            ]
//                        ))
//                        ->add('meconomie',NumberType::class,array(
//                            'label'     => 'Mise Journalière :',
//                            'required'  => false
//                        ))
//                        ->add('ranglivret',IntegerType::class,array(
//                            'label'     => 'Rang livret :',
//                            'required'  => false
//                        ))
//                        ->add('reflivret',TextType::class,array(
//                            'label'     => 'Référence du livret :',
//                            'required'  => false
//                        ))
//                        ->add('nbfeuillet',NumberType::class,array(
//                            'label'     => 'Nombre de feuillets :',
//                            'required'  => false
//                        ))
//                        ->add('nbmaxappoint',ChoiceType::class,array(
//                            'choices'   => array(31 =>31,30 => 30),
//                            'label'     => 'Appointement Maxi /feuillet :',
//                            'required'  => false
//                        ))
//                        ->add('dateinscr',DateType::class,array(
//                            'label'     => 'Date de souscription :',
//                            'required'  => false
//                        ))
//                        ->add('actif',CheckboxType::class,array(
//                            'label'     => 'Actif :',
//                            'required'  => false
//                        ))
//                        ->add('note',TextareaType::class,array(
//                            'label'     => 'Note :',
//                            'required'  => false
//                        ))
//                    ;
//                } else {
//                    $form = $event->getForm();
//                    $form
//                        ->add('compte', EntityType::class, array(
//                            'label' => 'Compte : *',
//                            'class' => Compte::class,
//                            'choices' => $form->getData() ? $form->getData()->getCompte() : [],
//                            'required' => false,
//                            'attr' => [
//                                'data-select' => 'true',
//                            ]
//                        ))
//                        ->add('meconomie',NumberType::class,array(
//                            'label'     => 'Mise journalière :',
//                            'required'  => false,
//                        ))
//                        ->add('ranglivret',IntegerType::class,array(
//                            'label'     => 'Rang livret :',
//                            'required'  => false
//                        ))
//                        ->add('reflivret',TextType::class,array(
//                            'label'     => 'Référence du livret :',
//                            'required'  => false
//                        ))
//                        ->add('nbfeuillet',NumberType::class,array(
//                            'label'     => 'Nombre de feuillets :',
//                            'required'  => false
//                        ))
//                        ->add('nbmaxappoint',ChoiceType::class,array(
//                            'choices'   => array(31 =>31,30 => 30),
//                            'label'     => 'Appointement Maxi /feuillet :',
//                            'required'  => false
//                        ))
//                        ->add('dateinscr',DateType::class,array(
//                            'label'     => 'Date de souscription :',
//                            'required'  => false
//                        ))
//                        ->add('actif',CheckboxType::class,array(
//                            'label'     => 'Actif :',
//                            'required'  => false
//                        ))
//                        ->add('note',TextareaType::class,array(
//                            'label'     => 'Note :',
//                            'required'  => false
//                        ))
//                    ;
//                }
//            }
//        );

        /*->add('compte')
        ->add('meconomie')
        ->add('ranglivret')
        ->add('reflivret')
        ->add('feuillet')
        ->add('nbmaxappoint')
        ->add('dateinscr')*/


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tontine::class,
        ]);
    }
}
