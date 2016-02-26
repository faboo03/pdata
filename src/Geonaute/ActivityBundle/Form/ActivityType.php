<?php
namespace Geonaute\ActivityBundle\Form;

use Geonaute\ActivityBundle\Document\Activity;
use Geonaute\ActivityBundle\Manager\LinkdataDecorator\LinkdataDecorator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class ActivityType extends AbstractType
{

    /**
     * @var LinkdataDecorator
     */
    private $linkdataDecorator;

    public function __construct($linkdataDecorator)
    {
        $this->linkdataDecorator = $linkdataDecorator;
    }

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

            $activityToken = $form->getData()->getActivityToken();
            $activityData = $this->linkdataDecorator->getActivityData($activityToken);

            $data->setStartdate($activityData['startdate']);
            $data->setDatasummaries($activityData['datasummaries']);

            $user = $this->linkdataDecorator->getUserData($activityData['ldid']);
            $data->setUser($user);
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