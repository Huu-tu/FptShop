<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Name', TextType::class,
        [
            'label' => "Category Name",
            'required' => true
        ])
        ->add('Description', TextType::class,
        [
            'label' => "Description",
            'required' => true
        ])
        ->add('Image', FileType::class,
        [
            'data_class' => null,
            'required' => is_null($builder ->getData() ->getImage())
        ])
        ->add('Date', DateType::class,
        [
            'widget' => 'single_text'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);

    }
}
