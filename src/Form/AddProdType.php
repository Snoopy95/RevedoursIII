<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddProdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('prod_name', TextType::class)
        ->add('prod_price', IntegerType::class)
        ->add('prod_descrip', TextType::class)
        ->add('prod_info', TextareaType::class)
        ->add('prod_stock', ChoiceType::class, [
            'choices' => [
                'Dispo' => true,
                'Non Dispo' => false
            ],
            'multiple'=>false,
            'expanded' => true
        ])
        ->add('categories', EntityType::class, [
            'class' => Categories::class,
            'choice_label' => 'cate_name',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}