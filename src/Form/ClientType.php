<?php

namespace App\Form;

use App\Entity\Client;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom',TextType::class,array(
                'label'     => 'Nom :',
                'required'  => false,
                'attr'      =>[
                    'placeholder'    =>  'Saisissez le nom de l adherent',
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

            ->add('datenais',BirthdayType::class,array(
                'label'     => 'Date Naissance',
                'required'  => false,
//                'attr'      =>['placeholder'    =>  'Saisissez sa date de naissance']
            ))

            ->add('commune', ChoiceType::class, array(
                'choices'     =>['Alibori' => 'Alibori',
                    'Atacora' => 'Atacora',
                    'Atlantique' => 'Atlantique',
                    'Borgou' => 'Borgou',
                    'Collines' => 'Collines',
                    'Couffo' => 'Couffo',
                    'Donga' => 'Donga',
                    'Littoral' => 'Littoral',
                    'Mono' => 'Mono',
                    'Ouémé' => 'Ouémé',
                    'Plateau' => 'Plateau',
                    'Zou' => 'Zou'],
                'label'     => 'Commune :',
                'required'  => false,
                'placeholder'    =>  'Selectionner la commune '
            ))

            ->add('arrondissement', ChoiceType::class, array(
                'choices'     =>['Banikoara' => 'Banikoara', 'Gogounou' => 'Gogounou',
                                  'Kandi' => 'Kandi', 'Karimama' => 'Karimama',
                                   'Malanville' => 'Malanville', 'Segbana' => 'Segbana',
                                   'Boukoumbé' => 'Boukoumbé', 'Cobly' => 'Cobly',
                                    'Kérou' => 'Kérou', 'Kouande' => 'Kouande',
                                    'Matéri' => 'Matéri', 'Natitingou' => 'Natitingou',
                                    'Pehonko' => 'Pehonko', 'Tanguiéta' => 'Tanguiéta',
                                    'Toucountouna' => 'Toucountouna',

                                    'Abomey-Calavi' => 'Abomey-Calavi','Allada' => 'Allada',
                                    'Kpomassè' => 'Kpomassè',  'Ouidah' => 'Ouidah',
                                     'Sô-Ava' => 'Sô-Ava', 'Toffo' => 'Toffo',
                                     'Zè' => 'Zè',

                                      'Bembéréké' => 'Bembéréké','Kaladé' => 'Kaladé',
                                      'N Dali' => 'N Dali',  'Nikki' => 'Nikki',
                                      'Parakou' => 'Parakou', 'Pèrèrè' => 'Pèrèrè',
                                      'Sinendé' => 'Sinendé',  'Tchaourou' => 'Tchaourou',


                                      'Bantè' => 'Bantè','Dassa-Zoumè' => 'Dassa-Zoumè',
                                      'Glazoué' => 'Glazoué',  'Ouèssè' => 'Ouèssè',
                                      'Savalou' => 'Savalou', 'Savè' => 'Savè',


                                      'Aplahoué' => 'Aplahoué',  'Djakotomey' => 'Djakotomey',
                                       'Dogbo' => 'Dogbo',  'Klouékanmè' => 'Klouékanmè',
                                       'Lalo' => 'Lalo',  'Toviklin' => 'Toviklin',


                                      'Bassila' => 'Bassila',  'Copargo' => 'Copargo',
                                       'Djougou' => 'Djougou',  'Ouaké' => 'Ouaké',


                                     'Cotonou' => 'Cotonou',

                                      'Athiémé' => 'Athiémé',  'Bopa' => 'Bopa',
                                      'Comè' => 'Comè',  'Grand-Popo' => 'Grand-Popo',
                                      'Houéyogbé' => 'Houéyogbé',  'Lokossa' => 'Lokassa',



                                      'Adjarra' => 'Adjarra',  'Adjohoun' => 'Adjohoun',
                                      'Aguégués' => 'Aguégués',  'Akpro-Missérété' => 'Akpro-Missérété',
                                      'Avrankou' => 'Avrankou',  'Bonou' => 'Bonou',
                                       'Dangbo' => 'Dangbo',  'Porto-Novo' => 'Porto-Novo',
                                       'Sèmè-Kpodji' => 'Sèmè-Kpodji',

                                      'Ifangni' => 'Ifangni',  'Adja-Ouèrè' => 'Adja-Ouèrè',
                                      'Kétou' => 'Kétou',  'Pobè' => 'Pobè',
                                      'Sakété' => 'Sakété',

                                      'Abomey' => 'Abomey',  'Agbangnizoun' => 'Agbangnizoun',
                                      'Bohicon' => 'Bohicon',  'Covè' => 'Covè',
                                      'Djidja' => 'Djidja',  'Ouinhi' => 'Ouinhi',
                                       'Za-Kpota' => 'Za-Kpota',  'Zagnanado' => 'Zagnanado',
                                        'Zogbodomey' => 'Zogbodomey'],
                'label'     => 'Arrondissement :',
                'required'  => false,
                'placeholder'    =>  'Selectionner l arrondissement '
            ))
            ->add('file',           FileType::class,array(
                'label'       =>  'Photo du client: ',
                'required'   => false,
                'help'          => '400x400 (taille recommandée)'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
