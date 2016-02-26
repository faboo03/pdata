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
            ->add('product_ids');

        $builder->addEventListener(FormEvents::POST_SUBMIT, function($event){
            $form = $event->getForm();
            $data = $form->getData();

            $activityToken = $form->getData()->getActivityToken();

            // update Activity
            try {
                $response = $this->linkdata->get("/activity/$activityToken/fullactivity.xml");
                if($response->getStatusCode() == 200) {
                    $xml = simplexml_load_string($response->getBody());
                }
                //get date
                $data->setStartdate(new \DateTime((string) $xml->ACTIVITY->STARTDATE));

                // get datasummary
                $datasummaries = array();
                foreach($xml->ACTIVITY->DATASUMMARY as $node) {
                    $datasummaries[(string)$node->VALUE['id']] = (string)$node->VALUE;
                }
                $data->setDatasummaries($datasummaries);
                $ldid = (string) $xml->ACTIVITY->USERID;
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                die();
            }

            // update User
            $response = $this->linkdata->get("/users/$ldid/profile.xml");
            if($response->getStatusCode() == 200) {
                $xml = simplexml_load_string($response->getBody());
            }

            $user = array(
                'ldid' => (string) $xml->USER->LDID,
                'gender' => (string) $xml->USER->GENDER,
                'birthdate' => (string) $xml->USER->BIRTHDATE,
                'language' => (string) $xml->USER->LANGUAGE,
                'country' => (string) $xml->USER->COUNTRY,
            );
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