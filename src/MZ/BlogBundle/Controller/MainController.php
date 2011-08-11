<?php

namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
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
	
	/**
	 * @Route("/sitemap.xml")
	 * @Template("MZBlogBundle:Main:sitemap.xml.twig")
	 */
	public function sitemapAction()
	{
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$post = $dm->getRepository('MZBlogBundle:Posts')->findAll();
		
		$response =  $this->render('MZBlogBundle:Main:sitemap.xml.twig',array('Posts'=>$post));
		$response->headers->set('Content-Type', 'text/xml');
		
		return $response;
	}
}
