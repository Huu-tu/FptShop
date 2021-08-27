<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Model;
use App\Entity\Size;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ModelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Name', TextType::class,
        [
            'label' => "Model Name",
            'required' => true
        ])

        ->add('Size',EntityType::class,
        [
            'class' => Size::class,
            'choice_label' => 'Size',
            'multiple' => false,  //true: select many, false: select only 1
            'expanded' => false  //true: checkbox   , false: drop-down list
        ])
        ->add('Category',EntityType::class,
        [
            'class' => Category::class,
            'choice_label' => 'Name',
            'multiple' => false,  //true: s
        ])
        // ->add('Model_Category', EntityType::class,
        // [
        //     'class' => Category::class,
        //     'choice_label' => "Name",
        //     'expanded' => false
        // ])
        // ->add('Model_Size', EntityType::class,
        // [
        //     'class' => Size::class,
        //     'choice_label' => "Name",
        //     'expanded' => false
        // ])
        ->add('Description', TextType::class,
        [
            'label' => "Description",
            'required' => true
        ])
        ->add('Price', IntegerType::class,
        [
            'required' => true
        ])
        ->add('MadeIn', TextType::class,
        [
            'label' => "Made In",
            'required' => true
        ])
        ->add('Amount', IntegerType::class,
        [
            'required' => true
        ])
        ->add('Image', FileType::class,
        [
            'data_class' => null,
            'required' => is_null($builder ->getData() ->getImage())
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Model::class,
        ]);
    }
}
