<?php

namespace Geonaute\ActivityBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Geonaute\ActivityBundle\Document\Activity;
use Geonaute\ActivityBundle\Form\ActivityType;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends FOSRestController
{
    public function indexAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $activity = $dm->getRepository('GeonauteActivityBundle:Activity') ->findOneBy(array('activity_token' => 'acitivytyioqyhdqs2'));

        return $activity;
    }

    public function postAction(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $serializer = $this->get('jms_serializer');

        $form = $this->createForm(new ActivityType(), new Activity());
        $form->submit(json_decode($request->getContent(), true));

        if($form->isValid()) {
            $dm->persist($form->getData());
            $dm->flush();

            return $form->getData();
        } else {
            return $form->getErrors();
        }
    }

    public function productListAction(Request $request, $product_id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $activities = $dm->getRepository('GeonauteActivityBundle:Activity')->findAll();

        return $activities;
    }
}
