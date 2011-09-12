<?php

namespace MZ\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MZ\BlogBundle\Document\Archives;

class ArchivesController extends Controller
{

    /**
     * @Route("/archive/")
     * @Template()
     */
    public function indexAction()
    {
        $dm = $this->get('doctrine.odm.mongodb.document_manager');
        $allPost = $dm->getRepository('MZBlogBundle:Posts')->findAll();

        $archive = $dm->getRepository('MZBlogBundle:Archives')->findOneByDate('AUGUST 2011');
        if (empty($archive)) {
            $archive = new Archives;
            $archive->setDate('AUGUST 2011');
        }
        foreach ($allPost as $post) {
            $archive->addPosts($post);
            $dm->persist($archive);
            $dm->flush();
        }


        $archives = $dm->getRepository('MZBlogBundle:Archives')->findAll();
        return array('Archives' => $archives);
    }

}
