<?php

namespace App\Form;

use App\Entity\ToDo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ToDoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la tache',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 100
                ])
                
            ])
            ->add('detail', TextType::class, [
                'label' => 'Detail de la tache',
                'constraints' => new Length([
                    'min' => 10,
                    'max' => 300
                ])
            ])
            ->add('date', DateType::class, [
                'label' => 'Date'
            ])
            ->add('urgent', CheckboxType::class, [
                'label' => 'Urgent',
                'required' => false
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ToDo::class,
        ]);
    }
}
