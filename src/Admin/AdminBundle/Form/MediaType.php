<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fili','file', array('required' => false, 'attr' => array('class' => 'img-new'), 'label_attr' => array('class' => 'lPhoto')))           
            ->add('file','file', array('required' => false))
            ->add('mediaTitre')
            ->add('dates', 'date', array(
                'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour')
            ))
            ->add('mediaDescrib','textarea',array('attr' => array('class' => 'ckeditor')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pages\CoreBundle\Entity\Media'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pages_corebundle_media';
    }
}
