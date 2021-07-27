<?php

namespace App\Form;

use App\Entity\Detailtontine;
use App\Entity\Tontine;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailtontineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tontine', EntityType::class, array(
                'required' => false,
                'label' => 'Référence (N°) Livret:',
                'class' => Tontine::class,
                'query_builder' => function (EntityRepository $jc) {
                    return $jc->createQueryBuilder('t')
                        ->orderBy('t.reflivret', 'ASC');
                },
                'attr' => [
                    'data-select' => 'true',
                    'onchange'      => 'remplirChamps()'
                ]
            ))
            //->add('client')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Detailtontine::class,
        ]);
    }
}
