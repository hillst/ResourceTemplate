<?php

namespace HillCMS\ResourceBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use HillCMS\ManageBundle\Controller\CMSController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HillCMS\ManageBundle\Entity\CmsPage;
use HillCMS\ManageBundle\Entity\CmsPageThings; 

class DefaultController extends CMSController
{
	private $pid = 3;
	
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$repo = $em->getRepository("HillCMSManageBundle:CmsPageThings");
    	$pagethings = $repo->findBy(array("pageid" => $this->pid)); //our people page id
    	if (sizeof($pagethings) === 0){
    			//empty page
    		return new Response("Error", 404);
    	}
    	$newsgroups = $this->buildPageGroups($pagethings);
    	
    	return $this->render('HillCMSResourceBundle:Default:index.html.twig', array( "main" => $newsgroups["Main"],
    																				  "contacts" => $newsgroups["Contact"], 
    																				  "resources" => $newsgroups["Resources"]));
    	
    }
}
