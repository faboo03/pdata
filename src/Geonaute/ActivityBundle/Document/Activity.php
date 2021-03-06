<?php

namespace Geonaute\ActivityBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * @MongoDB\Document
 * @JMS\ExclusionPolicy("none")
 */
class Activity
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Assert\NotNull
     * @Assert\NotBlank
     * @JMS\Type("string")
     *
     */
    protected $activity_token;

    /**
     * @MongoDB\Date
     * @JMS\Type("DateTime<'Y-m-d'>")
     */
    protected $startdate;

    /**
     * @MongoDB\String
     * @JMS\Type("string")
     */
    protected $sport_id;

    /**
     * @MongoDB\Hash
     * @JMS\Type("array")
     */
    protected $datasummaries = array();

    /**
     * @MongoDB\Hash
     * @JMS\Type("array")
     */
    protected $product_ids = array();

    /**
     * @MongoDB\Hash
     * @JMS\Type("array")
     */
    protected $user = array();

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set activityToken
     *
     * @param string $activityToken
     * @return self
     */
    public function setActivityToken($activityToken)
    {
        $this->activity_token = $activityToken;
        return $this;
    }

    /**
     * Get activityToken
     *
     * @return string $activityToken
     */
    public function getActivityToken()
    {
        return $this->activity_token;
    }

    /**
     * Set startdate
     *
     * @param date $startdate
     * @return self
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
        return $this;
    }

    /**
     * Get startdate
     *
     * @return date $startdate
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set datasummaries
     *
     * @param collection $datasummaries
     * @return self
     */
    public function setDatasummaries($datasummaries)
    {
        $this->datasummaries = $datasummaries;
        return $this;
    }

    /**
     * Get datasummaries
     *
     * @return collection $datasummaries
     */
    public function getDatasummaries()
    {
        return $this->datasummaries;
    }

    /**
     * Set productIds
     *
     * @param collection $productIds
     * @return self
     */
    public function setProductIds($productIds)
    {
        $this->product_ids = $productIds;
        return $this;
    }

    /**
     * Get productIds
     *
     * @return collection $productIds
     */
    public function getProductIds()
    {
        return $this->product_ids;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get productIds
     *
     * @return collection $productIds
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getSportId()
    {
        return $this->sport_id;
    }

    /**
     * @param mixed $sport_id
     */
    public function setSportId($sport_id)
    {
        $this->sport_id = $sport_id;
        return $this;
    }

}
