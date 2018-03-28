<?php

namespace MyApp\ParcBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ref')->add('modele')->add('serie')->add('datec')
            ->add('couleur',ChoiceType::class,array(
            'choices'  => array(
                'Rouge' => 'r',
                'noire' => 'n',
                'jaune' =>'j',

            )))
            ->add('marque',EntityType::class, array(
                'class' => 'MyAppParcBundle:Marque',
                'choice_label' => 'libelle'
            ))
            ->add('ajouter',SubmitType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\ParcBundle\Entity\Voiture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_parcbundle_voiture';
    }


}
