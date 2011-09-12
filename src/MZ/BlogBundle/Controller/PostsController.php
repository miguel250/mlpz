<?php

namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostsController extends Controller
{

    /**
     * @Route("/post/{slug}")
     * @Template()
     */
    public function indexAction($slug)
    {
        $dm = $this->get('doctrine.odm.mongodb.document_manager');
        $post = $dm->getRepository('MZBlogBundle:Posts')->findOneBySlug($slug);

        if (empty($post)) {
            throw new NotFoundHttpException("The post couldn't be found");
        }
        return array('post' => $post);
    }

}
