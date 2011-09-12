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
        $archives = $dm->getRepository('MZBlogBundle:Archives')->findAll();
        return array('Archives' => $archives);
    }

}
