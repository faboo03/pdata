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

    private $linkdata;
    public function __construct($linkdata)
    {
        $this->linkdata = $linkdata;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activity_token')
            ->add('product_ids', 'choice', array('multiple' => true));

        $builder->addEventListener(FormEvents::POST_SUBMIT, function($event){
            $form = $event->getForm();
            $data = $form->getData();

            $activityToken = $form->getData()->getActivityToken();
            try{
                $response = $this->linkdata->get("/activity/$activityToken/fullactivity.xml");
                if($response->getStatusCode() == 200) {
                    $xml = simplexml_load_string($response->getBody());
                }
                $data->setStartdate(new \DateTime((string) $xml->ACTIVITY->STARTDATE));
                $datasummaries = array();
                foreach($xml->ACTIVITY->DATASUMMARY as $node) {
                    $datasummaries[(string)$node->VALUE['id']] = (string)$node->VALUE;
                }
                $data->setDatasummaries($datasummaries);
            } catch (\Exception $e) {
//                $this->logger = ;
            }
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