<?php

namespace Geonaute\ActivityBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Geonaute\ActivityBundle\Document\Activity;

class LoadActivityData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $activity = new Activity();
        $activity->setActivityToken('token1');
        $activity->setStartdate(new \DateTime());
        $activity->setDatasummaries(array(
            12 => 124,
            13 => 1500,
        ));
        $activity->setProductIds(array(
            '12345',
            '6789',
            '09875',
        ));

        $manager->persist($activity);
        $manager->flush();
    }
}