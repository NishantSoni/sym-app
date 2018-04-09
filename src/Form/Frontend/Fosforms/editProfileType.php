<?php 

namespace App\Form\Frontend\Fosforms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class editProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname' , TextType::class , array(
    						    'required' 	=> true,
                                'attr' => ['class' => 'form-control']
                                ))
            ;
    }

    public function getParent()
    {
        return 'fos_user_profile_edit';
    }

    public function getName()
    {
        return 'app_user_profile_edit';
    }
}