<?php

namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MZ\BlogBundle\Document\Posts;
use MZ\BlogBundle\Document\Tags;

class MainController extends Controller
{
	/**
	 * @Route("/")
	 * @Template()
	 */
	public function indexAction()
	{
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$post = $dm->getRepository('MZBlogBundle:Posts')->findAll();
		return array('Posts'=>$post);
	}
}
