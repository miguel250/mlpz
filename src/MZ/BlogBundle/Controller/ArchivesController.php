<?php
namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArchivesController extends Controller
{
	/**
	 * @Route("/archive/")
	 * @Template()
	 */
	public function indexAction()
	{
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$archives = $dm->getRepository('MZBlogBundle:Archives')->findAll();
		return array('Archives'=>$archives);
	}
}
