<?php

namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
		return array();
	}

	/**
	 * @Route("/admin/new/")
	 * @Template()
	 */
	public function createAction()
	{
		$post = new Posts();

		$tag = 'php,symfony2,Mysql,apache';

		$tagsArray = explode(",", strtolower($tag));
		$dm = $this->get('doctrine.odm.mongodb.document_manager');

		$post->setTitle('miguel3');
		$post->setBody('miguel');
		$dm->persist($post);
		$dm->flush();

		foreach ($tagsArray as $tag) {
			$tags = new Tags();
			$dbTags = $dm->getRepository('MZBlogBundle:Tags')->findOneByName($tag);
			if(empty($dbTags)){
				$tags->setName($tag);
				$tags->addPost($post);
				$post->addTags($tags);
				$dm->persist($tags);
				$dm->flush();
			}else{
				$dbTags->addPost($post);
				$post->addTags($dbTags);
				$dm->persist($dbTags);
				$dm->flush();
			}
		}
		$archive = new Archives();
		$archive->addPosts($post);
		return array();
	}
}
