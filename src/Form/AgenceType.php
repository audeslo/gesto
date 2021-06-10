<?php

namespace App\Form;

use App\Entity\Agence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('codeagence',TextType::class,array(
                'label'     => 'Code Agence :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez le code dagence']
            ))
            ->add('libelle',TextType::class,array(
                'label'     => 'libelle :',
                'required'  => false,
                'attr'      =>['placeholder'    =>  'Saisissez le libelle']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agence::class,
        ]);
    }
}
