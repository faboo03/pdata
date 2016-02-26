<?php
namespace Geonaute\ActivityBundle\Form;

use Geonaute\ActivityBundle\Document\Activity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class ActivityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activity_token')
            ->add('product_ids');

        $builder->addEventListener(FormEvents::POST_SUBMIT, function($event){
            $form = $event->getForm();
            $data = $form->getData();
            $data->setStartdate(new \DateTime());
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Geonaute\ActivityBundle\Document\Activity'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return null;
    }
}