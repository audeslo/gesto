<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('agence', EntityType::class, array(
                'label' => 'Agence:*',
                'class' => Agence::class,
                'placeholder' => 'Veuillez sélectionner l\'agence',
                'choice_label'  =>  'libelle',
                'required' => false,
                'attr' => ['data-select' => 'true']
            ))

            ->add('nom', TextType::class, array(
                'label'     => 'Nom :',
                'required'  => false,
                'attr'   =>[
                    'oninput'   =>  'toutMajuscule(this)'
                ]
            ))
            ->add('prenom', TextType::class, array(
                'label'     => 'Prénom :',
                'required'  => false,
                'attr'      =>[
                    'oninput'   =>  'premiereLettreMajuscule(this)'
                ]
            ))
             ->add('sexe', ChoiceType::class, array(
                 'choices'   => ['Masculin' => 'M', 'Féminin'   =>  'F'],
                 'expanded'  => true,
                 'label'     => 'Sexe: ',
             ))

            ->add('telephone', TextType::class, array(
                'label'     => 'Téléphone :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez le N° Tél']
            ))
            ->add('email', EmailType::class, array(
                'label'     => 'E-Mail:  :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez votre mail']
            ))
            ->add('username', TextType::class, array(
                'label'     => 'login/nom utilisateur :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez le login']
            ))
            ->add('password', RepeatedType::class, array(
                'type'     => PasswordType::class,
                'first_options'         => array('label'   => 'Password'),
                'second_options'        =>['label'    =>  'Répéter le mot de Password']
            ))
            ->add('roles', ChoiceType::class, array(
                'choices'   => [
                    'Utilisateur' =>'ROLE_USER' ,
                    'Responsable (Agence)' => 'ROLE_RESPO',
                    'Superviseur' => 'ROLE_SUP',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Super Admin' => 'ROLE_SUPER_ADMIN'
                ],
                'label'     => 'Roles :',
                'required'  => false,
                'multiple'  => true,
                'expanded'  => false,

            ))
            ->add('changedpassword', CheckboxType::class, array(
                'label'       =>    'Changer mot de passe à la connexion',
                'required'  => false,
            ))

            ->add('enabled', CheckboxType::class, array(
                'label'       =>    'Activer',
                'required'  => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
