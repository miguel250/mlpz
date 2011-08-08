<?php
namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostsController extends Controller
{
	/**
	 * @Route("/post/{slug}")
	 * @Template()
	 */
	public function indexAction($slug)
	{
		return array();
	}
}
