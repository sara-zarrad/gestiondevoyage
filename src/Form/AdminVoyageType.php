<?php

namespace App\Form;

use App\Entity\Voyage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminVoyageType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('titre', TextType::class, [
            'label' => 'Titre'
        ])
        ->add('lieuDepart', TextType::class, [
            'label' => 'Lieu de départ'
        ])
        ->add('lieuArrive', TextType::class, [
            'label' => 'Lieu d\'arrivée'
        ])
        ->add('dateDepart', DateTimeType::class, [
            'label' => 'Date de départ',
            'widget' => 'single_text',
            'html5' => true,
        ])
        ->add('dateArrive', DateTimeType::class, [
            'label' => 'Date d\'arrivée',
            'widget' => 'single_text',
            'html5' => true,
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
            'required' => false
        ])
        ->add('image', FileType::class, [
            'label' => 'Image',
            'required' => false
        ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
