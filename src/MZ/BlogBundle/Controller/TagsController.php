<?php
namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TagsController extends Controller
{
	/**
	 * @Route("/tag/{name}")
	 * @Template()
	 */
	public function indexAction($name)
	{
		return array();
	}
}
