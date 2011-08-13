<?php
namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class TagsController extends Controller
{
	/**
	 * @Route("/tag/{name}")
	 *  @Template()
	 */
	public function indexAction($name)
	{
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$tag = $dm->getRepository('MZBlogBundle:Tags')->findOneByName($name);
		
		if(empty($tag)){
			throw new NotFoundHttpException("The tag couldn't be found");
		}
		return array('tag'=>$tag);
	}
}
