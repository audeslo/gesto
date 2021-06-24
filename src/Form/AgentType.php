<?php

namespace App\Form;

use App\Entity\Agent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomag',TextType::class,array(
                'label'     => 'Nom :',
                'required'  => false,
                'attr'      =>[
                    'placeholder'    =>  'Saisissez le nom de l agent',
                    'oninput'   =>  'premiereLettreMajuscule(this)'
                ]
            ))

            ->add('prenomag',TextType::class,array(
                'label'     => 'Prénom(s) :',
                'required'  => false,
                'attr'      =>[
                    'placeholder'    =>  'Saisissez le prénom de l agent',
                    'oninput'   =>  'premiereLettreMajuscule(this)'
                ]
            ))
            ->add('sexe', ChoiceType::class, array(
                'choices'   => ['Masculin' => 'M', 'Féminin'   =>  'F'],
                'expanded'  => true,
                'label'     => 'Sexe: ',
            ))

            ->add('datenaiss',BirthdayType::class,array(
                'label'     => 'Date Naissance',
                'required'  => false,
//                'attr'      =>['placeholder'    =>  'Saisissez sa date de naissance']
            ))
            ->add('lieunaiss',TextType::class,array(
                'label'     => 'Lieu :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez le lieu de l agent']
            ))

            ->add('telag',TextType::class,array(
                'label'     => 'Lieu :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez le numéro duu téléphone']
            ))
            ->add('bpag',TextType::class,array(
                'label'     => 'Boite postale :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez la boite postale de l agent']
            ))

        ->add('dateembaucheag',DateType::class,array(
            'label'     => 'Date d embauche :',
            'required'  => false
        ))

            ->add('adressevilleag',TextType::class,array(
                'label'     => 'Adresse ville:',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez l adresse de ville']
            ))
            ->add('adresserueag',TextType::class,array(
                'label'     => 'Adresse Rue :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez l adresse rue']
            ))

            ->add('situationmatri', ChoiceType::class, array(
                'choices'     =>['Célibataire' => 'Célibataire',
                    'Célibataire avec enfant' => 'Célibataire avec enfant',
                'Marié(e)' => 'Marié(e)',
                  'Veuf/veuve' => 'Veuf/veuve'],
                'label'     => 'Situation matrimoniale :',
                'required'  => false,
                'placeholder'    =>  'Selectionner la situation '
            ))

            ->add('nbreenft',IntegerType::class,array(
                'label'     => 'Nombre d enfant :',
                'required'  => false
            ))

            ->add('numerocompte',IntegerType::class,array(
                'label'     => 'Numéro de compte :',
                'required'  => false
            ))

            ->add('file',           FileType::class,array(
                'label'       =>  'Photo de l agent: ',
                'required'   => false,
                'help'          => '400x400 (taille recommandée)'
            ))
            /*  ->add('nomcompletag')
           ->add('actif')*/
            /* ->add('slug')
             ->add('editedOn')
             ->add('createdOn')
             ->add('editedBy')
             ->add('createdBy')*/
           /* ->add('url')
           ->add('alt')*/

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
        ]);
    }
}
