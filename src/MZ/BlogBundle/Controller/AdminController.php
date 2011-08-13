<?php

namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MZ\BlogBundle\Document\Posts;
use MZ\BlogBundle\Document\Tags;
use MZ\BlogBundle\Document\Archives;


class AdminController extends Controller
{
	/**
	 * @Route("/admin/")
	 * @Template()
	 */
	public function indexAction()
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		$userid  = $user->getId();

		$post = new Posts();


		$form = $this->get('mz_blog.PostForm');
		$postHandler = $this->get('mz_blog.NewPostHandler');
		if($postHandler->Process($post)){
			$slug = $postHandler->PostSlug();
			$url = $this->get('router')->generate('mz_blog_posts_index',array('slug'=>$slug));
			return new RedirectResponse($url);
		}

		return array('form' => $form->createView());
	}

	/**
	 * @Route("/admin/edit/{slug}")
	 * @Template("MZBlogBundle:Admin:index.html.twig")
	 */
	public function editAction($slug)
	{
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$post = $dm->getRepository('MZBlogBundle:Posts')->findOneBySlug($slug);

		if(empty($post)){
			throw new NotFoundHttpException("The post couldn't be found");
		}

		$form = $this->get('mz_blog.PostForm');
		$postHandler = $this->get('mz_blog.EditPostHandler');

		if($postHandler->Process($post)){
			$slug = $postHandler->PostSlug();
			$url = $this->get('router')->generate('mz_blog_posts_index',array('slug'=>$slug));
			return new RedirectResponse($url);
		}

		return array('form' => $form->createView());
	}
}
