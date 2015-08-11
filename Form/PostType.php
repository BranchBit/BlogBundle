<?php

namespace BBIT\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('published', 'checkbox', array('required' => false))
            ->add('slug')
            ->add('body', null, array('attr' => array( 'data-provide'=>'markdown')))
            ->add('createdAt')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BBIT\BlogBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bbit_blogbundle_post';
    }
}
