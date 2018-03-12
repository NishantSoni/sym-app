<?php 

namespace App\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PostCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title' , TextType::class , array(
    						    'required' 	=> true,
                                'attr' => ['class' => 'form-control']
                                ))
            ->add('description', TextareaType::class , array(
							    'required' => true,
                                'attr' => ['class' => 'form-control']
                                ))
            ->add('category', ChoiceType::class , array(
								'required' => true,
                                'choices' => [
                                                'Select category' => 0,
                                                '1' => 1,
                                                '2' => 2,
                                                '3' => 3,
                                                '4' => 4
                                            ],
                                'attr' => ['class' => 'form-control']
                                ))
            ->add('save', SubmitType::class, [
                                'attr' => ['class' => 'btn btn-info']
                                ])
        ;
    }
}