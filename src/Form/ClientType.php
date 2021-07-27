<?php

namespace App\Form;

use App\Entity\Client;

use App\Entity\Commune;
use App\Entity\Departement;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departement', EntityType::class, array(
                'required' => false,
                'label' => 'Département : *',
                'choice_label' => 'libelle',
                'class' => Departement::class,
                'query_builder' => function (EntityRepository $jc) {
                    return $jc->createQueryBuilder('d')
                        ->select('d')
                        ->andWhere('d.actif =?1')
                        ->setParameter(1,true)
                        ->orderBy('d.libelle', 'ASC');
                },
                'attr' => [
                    'data-select' => 'true',
                ]
            ));

        $builder->get('departement')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $form->getParent()
                    ->add('commune', EntityType::class, array(
                        'label' => 'Commune :*',
                        'class' => Commune::class,
                        'choices' => $form->getData() ? $form->getData()->getCommunes() : [],
                        'required' => false,
                        'attr' => [
                            'data-select' => 'true'
                        ]
                    ))
                    ->add('nom',TextType::class,array(
                        'label'     => 'Nom :',
                        'required'  => false,
                        'attr'      =>[
                            'oninput'   =>  'toutMajuscule(this)'
                        ]
                    ))
                    ->add('prenoms',TextType::class,array(
                        'label'     => 'Prénom(s) :',
                        'required'  => false,
                        'attr'      =>[
                            'placeholder'    =>  'Saisissez le prénom de l adherent',
                            'oninput'   =>  'premiereLettreMajuscule(this)'
                        ]
                    ))

                    ->add('sexe', ChoiceType::class, array(
                        'choices'   => ['Masculin' => 'M', 'Féminin'   =>  'F'],
                        'expanded'  => true,
                        'label'     => 'Sexe: ',
                    ))

                    ->add('lieu',TextType::class,array(
                        'label'     => 'Lieu :',
                        'required'  => false,
                        'attr'      =>['placeholder'    =>  'Saisissez le lieu de l adherent']
                    ))
                    ->add('profession',TextType::class,array(
                        'label'     => 'Profession :',
                        'required'  => false,
                        'attr'      =>['placeholder'    =>  'Saisissez la profession de l adherent']
                    ))
                    ->add('activite',TextType::class,array(
                        'label'     => 'Activité :',
                        'required'  => false,
                        'attr'      =>[
                            'placeholder'    =>  'Saisissez son activité',

                        ]
                    ))

                    ->add('telephone',TextType::class,array(
                        'label'     => 'Téléphone:',
                        'required'  => false,
                        'attr'      =>['placeholder'    =>  'Saisissez son numéro de téléphone']
                    ))
                    ->add('arrondissement',TextType::class,array(
                        'label'     => 'Arrondissement:',
                        'required'  => false,
                    ))

                    ->add('quartier',TextType::class,array(
                        'label'     => 'Quartier:',
                        'required'  => false,
                        'attr'      =>['placeholder'    =>  'Saisissez son quartier']
                    ))

                    ->add('datenais',BirthdayType::class,array(
                        'label'     => 'Date Naissance',
                        'required'  => false,
//                'attr'      =>['placeholder'    =>  'Saisissez sa date de naissance']
                    ))
                    ->add('file',           FileType::class,array(
                        'label'       =>  'Photo du client: ',
                        'required'   => false,
                        'help'          => '400x400 (taille recommandée)'
                    ))


                ;
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
//                /* @var $poste Poste*/
                $departement = $data->getdepartement();
                if ($departement) {
                    $form = $event->getForm();
                    $form
                        ->add('commune', EntityType::class, array(
                            'label' => 'Commune : *',
                            'class' => Commune::class,
                            'choices' => $departement ? $departement->getCommunes() : [],
                            'required' => false,
                            'attr' => [
                                'data-select' => 'true'
                            ]
                        ))
                        ->add('nom',TextType::class,array(
                            'label'     => 'Nom :',
                            'required'  => false,
                            'attr'      =>[
                                'oninput'   =>  'toutMajuscule(this)'
                            ]
                        ))
                        ->add('prenoms',TextType::class,array(
                            'label'     => 'Prénom(s) :',
                            'required'  => false,
                            'attr'      =>[
                                'placeholder'    =>  'Saisissez le prénom de l adherent',
                                'oninput'   =>  'premiereLettreMajuscule(this)'
                            ]
                        ))
                        ->add('sexe', ChoiceType::class, array(
                            'choices'   => ['Masculin' => 'M', 'Féminin'   =>  'F'],
                            'expanded'  => true,
                            'label'     => 'Sexe: ',
                        ))
                        ->add('lieu',TextType::class,array(
                            'label'     => 'Lieu :',
                            'required'  => false,
                            'attr'      =>['placeholder'    =>  'Saisissez le lieu de l adherent']
                        ))
                        ->add('profession',TextType::class,array(
                            'label'     => 'Profession :',
                            'required'  => false,
                            'attr'      =>['placeholder'    =>  'Saisissez la profession de l adherent']
                        ))
                        ->add('activite',TextType::class,array(
                            'label'     => 'Activité :',
                            'required'  => false,
                            'attr'      =>[
                                'placeholder'    =>  'Saisissez son activité',

                            ]
                        ))
                        ->add('arrondissement',TextType::class,array(
                            'label'     => 'Arrondissement:',
                            'required'  => false,
                        ))

                        ->add('telephone',TextType::class,array(
                            'label'     => 'Téléphone:',
                            'required'  => false,
                            'attr'      =>['placeholder'    =>  'Saisissez son numéro de téléphone']
                        ))

                        ->add('quartier',TextType::class,array(
                            'label'     => 'Quartier:',
                            'required'  => false,
                            'attr'      =>['placeholder'    =>  'Saisissez son quartier']
                        ))

                        ->add('datenais',BirthdayType::class,array(
                            'label'     => 'Date Naissance',
                            'required'  => false,
//                'attr'      =>['placeholder'    =>  'Saisissez sa date de naissance']
                        ))
                        ->add('file',           FileType::class,array(
                            'label'       =>  'Photo du client: ',
                            'required'   => false,
                            'help'          => '400x400 (taille recommandée)'
                        ))
                    ;
                } else {
                    $form = $event->getForm();
                    $form
                        ->add('commune', EntityType::class, array(
                            'label' => 'Commune : *',
                            'class' => Commune::class,
                            'choices' => $form->getData() ? $form->getData()->getCommune() : [],
                            'required' => false,
                            'attr' => [
                                'data-select' => 'true',
                            ]
                        ))
                        ->add('nom',TextType::class,array(
                            'label'     => 'Nom :',
                            'required'  => false,
                            'attr'      =>[
                                'oninput'   =>  'toutMajuscule(this)'
                            ]
                        ))
                        ->add('prenoms',TextType::class,array(
                            'label'     => 'Prénom(s) :',
                            'required'  => false,
                            'attr'      =>[
                                'placeholder'    =>  'Saisissez le prénom de l adherent',
                                'oninput'   =>  'premiereLettreMajuscule(this)'
                            ]
                        ))
                        ->add('sexe', ChoiceType::class, array(
                            'choices'   => ['Masculin' => 'M', 'Féminin'   =>  'F'],
                            'expanded'  => true,
                            'label'     => 'Sexe: ',
                        ))
                        ->add('lieu',TextType::class,array(
                            'label'     => 'Lieu :',
                            'required'  => false,
                            'attr'      =>['placeholder'    =>  'Saisissez le lieu de l adherent']
                        ))
                        ->add('profession',TextType::class,array(
                            'label'     => 'Profession :',
                            'required'  => false,
                            'attr'      =>['placeholder'    =>  'Saisissez la profession de l adherent']
                        ))
                        ->add('activite',TextType::class,array(
                            'label'     => 'Activité :',
                            'required'  => false,
                            'attr'      =>[
                                'placeholder'    =>  'Saisissez son activité',

                            ]
                        ))

                        ->add('telephone',TextType::class,array(
                            'label'     => 'Téléphone:',
                            'required'  => false,
                            'attr'      =>['placeholder'    =>  'Saisissez son numéro de téléphone']
                        ))

                        ->add('quartier',TextType::class,array(
                            'label'     => 'Quartier:',
                            'required'  => false,
                            'attr'      =>['placeholder'    =>  'Saisissez son quartier']
                        ))
                        ->add('arrondissement',TextType::class,array(
                            'label'     => 'Arrondissement:',
                            'required'  => false,
                        ))

                        ->add('datenais',BirthdayType::class,array(
                            'label'     => 'Date Naissance',
                            'required'  => false,
//                'attr'      =>['placeholder'    =>  'Saisissez sa date de naissance']
                        ))
                        ->add('file',           FileType::class,array(
                            'label'       =>  'Photo du client: ',
                            'required'   => false,
                            'help'          => '400x400 (taille recommandée)'
                        ))
                    ;
                }
            }
        );




    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
