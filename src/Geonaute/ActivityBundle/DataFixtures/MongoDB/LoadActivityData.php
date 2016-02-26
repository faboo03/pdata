<?php

namespace Geonaute\ActivityBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Geonaute\ActivityBundle\Document\Activity;

class LoadActivityData implements FixtureInterface
{

    private function getTokens() {
        return array(
            array('id' => '1','token' => '1e1c76afc3834fb621fb','startdate' => '2011-12-05 19:36:23'),
            array('id' => '2','token' => 'c543a99d0fc5e1a50714','startdate' => '2011-12-04 10:43:04'),
            array('id' => '3','token' => 'dd8934e276ec09793797','startdate' => '2011-12-06 13:16:07'),
            array('id' => '4','token' => 'ac7b8c20aa50ed54d1c6','startdate' => '2011-12-03 11:01:08'),
            array('id' => '5','token' => '08bd1b279e5f543f1f27','startdate' => '2011-12-04 11:45:04'),
            array('id' => '6','token' => '3b678ef1958e3ecaf6dd','startdate' => '2011-12-02 12:31:24'),
            array('id' => '7','token' => 'bfa6bfbccffea9bcf66d','startdate' => '2011-12-05 19:36:23'),
            array('id' => '8','token' => '51f7b29f97b91ce8412b','startdate' => '2011-12-04 10:43:04'),
            array('id' => '9','token' => 'd32c3b870f83271d2c86','startdate' => '2011-12-02 12:31:24'),
            array('id' => '10','token' => '324cff5fe1edac90734d','startdate' => '2011-12-06 13:16:07'),
            array('id' => '11','token' => 'b743dadef4f04766d6ec','startdate' => '2011-12-03 11:01:08'),
            array('id' => '12','token' => 'cf7669d3b15b932af04a','startdate' => '2011-12-04 11:45:04'),
            array('id' => '13','token' => 'af48e0d663c4d121ffa2','startdate' => '2011-12-02 12:31:24'),
            array('id' => '14','token' => '89c9fabb062c5443f50d','startdate' => '2011-12-04 11:45:04'),
            array('id' => '15','token' => 'e8a034ff25bf31f6ffe9','startdate' => '2011-12-03 11:01:08'),
            array('id' => '16','token' => '22cc751b5761d57647d5','startdate' => '2011-12-06 13:16:07'),
            array('id' => '17','token' => 'fb2ced7fad4e14cb1f4b','startdate' => '2011-12-04 10:43:04'),
            array('id' => '18','token' => '1df1973f42d9d428496c','startdate' => '2011-12-05 19:36:23'),
            array('id' => '19','token' => '8d5d38a59c72e5f3fa12','startdate' => '2011-12-05 19:36:23'),
            array('id' => '20','token' => '0cfb028d82bc46427818','startdate' => '2011-12-04 12:00:00'),
            array('id' => '21','token' => '44147979494eca2904e8','startdate' => '2011-12-06 13:16:07'),
            array('id' => '22','token' => '9dbbe695c8942c59e185','startdate' => '2011-12-03 11:01:08'),
            array('id' => '23','token' => 'b93dac83890fbde22b20','startdate' => '2012-03-28 12:00:00'),
            array('id' => '24','token' => 'f141f42ed295975f6445','startdate' => '2011-12-02 12:31:24'),
            array('id' => '31','token' => '788d535fce0087776db6','startdate' => '2011-12-05 19:36:23'),
            array('id' => '32','token' => 'd1bd9dc75ba9a29c8e71','startdate' => '2011-12-04 10:43:04'),
            array('id' => '33','token' => 'afef8fef5d50ca6c88ca','startdate' => '2011-12-06 13:16:07'),
            array('id' => '34','token' => '3d9cd4904cc42cf30561','startdate' => '2011-12-03 11:01:08'),
            array('id' => '35','token' => '6b9f8dd91faaadf44352','startdate' => '2011-12-04 11:45:04'),
            array('id' => '36','token' => 'a5b142a81b7939119b24','startdate' => '2011-12-02 12:31:24')
        );

    }
    public function load(ObjectManager $manager)
    {
        foreach($this->getTokens() as $row) {
            $activity = new Activity();
            $activity->setActivityToken($row['token']);
            $activity->setStartdate(new \DateTime($row['startdate']));

            $activity->setDatasummaries(array(
                12 => round(rand(1, 1000), 0),
                21 => round(rand(1, 150000),0),
            ));

            if(round(rand(0,1),0) == 1) {
                $activity->setProductIds(array(
                    '12345'
                ));
            } else {
                $activity->setProductIds(array(
                    '54321'
                ));
            }

            $manager->persist($activity);
        }
        $manager->flush();
    }
}