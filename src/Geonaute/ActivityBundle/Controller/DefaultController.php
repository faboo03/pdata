<?php

namespace Geonaute\ActivityBundle\Controller;

use Geonaute\ActivityBundle\Document\Activity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $activity = new Activity;
        $activity->setActivityToken('acitivytyioqyhdqs');
        $activity->setStartdate(new \DateTime('2016-01-01'));
        $activity->setProductIds(array(
            '12345', '123455'
        ));

        $activity->setDatasummaries(array(
            '12' => 123, '11' => 1234
        ));

        return $activity;
    }
}
