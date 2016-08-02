<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolutionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file', array('required' => false, 'attr' => array('class' => 'img-new'), 'label_attr' => array('class' => 'lPhoto')))
            ->add('solNom')
            ->add('solFonc')
            ->add('solDescrib','textarea',array('attr' => array('class' => 'ckeditor')))
            ->add('solLink')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pages\CoreBundle\Entity\Solution'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pages_corebundle_solution';
    }
}
