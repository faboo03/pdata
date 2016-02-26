<?php

namespace Geonaute\ActivityBundle\Manager;

class LinkdataDecorator
{
    private $linkdata;
    private $logger;

    public function __construct($linkdata, $logger = null)
    {
        $this->linkdata = $linkdata;
        $this->logger = $logger;
    }

    public function getActivityData($activityToken) {
        // update Activity
        $returnArray = array();
        try {
            $response = $this->linkdata->get("/activity/$activityToken/fullactivity.xml");
            if($response->getStatusCode() == 200) {
                $xml = simplexml_load_string($response->getBody());
            }
            $returnArray['startdate'] = new \DateTime((string) $xml->ACTIVITY->STARTDATE);

            // get datasummary
            $datasummaries = array();
            foreach($xml->ACTIVITY->DATASUMMARY as $node) {
                $datasummaries[(string)$node->VALUE['id']] = (string)$node->VALUE;
            }
            $returnArray['datasummaries'] = $datasummaries;
            $returnArray['ldid'] = (string) $xml->ACTIVITY->USERID;
        } catch (\Exception $e) {
            if($this->logger) {
                $this->logger->alert('Error FullActivity : '.$e->getMessage());
            }
        }

        $this->logger->info('ActivityIsOk : '.print_r($returnArray, true));

        return $returnArray;
    }

    public function getUserData($ldid) {

        try {
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

        } catch (\Exception $e) {
            if($this->logger) {
                $this->logger->alert('Error Activity : '.$e->getMessage());
            }
        }

        $this->logger->info('UserIsOk : '.print_r($user, true));

        return $user;
    }

}