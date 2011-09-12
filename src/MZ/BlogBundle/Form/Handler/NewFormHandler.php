<?php

namespace MZ\BlogBundle\Form\Handler;

use MZ\BlogBundle\Document\Posts;
use MZ\BlogBundle\Document\Tags;
use MZ\BlogBundle\Document\Archives;

class NewFormHandler
{

    private $post;
    private $form;
    private $request;
    private $dm;
    private $slug;

    public function __construct($form, $request, $documentManager)
    {

        $this->form = $form;
        $this->request = $request;
        $this->dm = $documentManager;
    }

    public function PostSlug()
    {
        return $this->slug;
    }

    public function Process($post)
    {
        $this->post = $post;
        $this->form->setData($this->post);

        if ('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $post = $this->dm->getRepository('MZBlogBundle:Posts')->findOneBySlug($this->post->getSlug());

                if (!empty($post)) {
                    $date = date('dny');
                    $slug = $date . '-' . $this->post->getSlug();
                    $this->post->setSlug($slug);
                }

                $tagsArray = explode(",", strtolower($this->post->getTagString()));

                $this->dm->persist($this->post);
                $this->dm->flush();

                foreach ($tagsArray as $tag) {
                    $tags = new Tags();
                    $tag = trim($tag);
                    $dbTags = $this->dm->getRepository('MZBlogBundle:Tags')->findOneByName($tag);
                    if (empty($dbTags)) {
                        $tags->setName($tag);
                        $tags->addPost($this->post);
                        $this->post->addTags($tags);
                        $this->dm->persist($tags);
                        $this->dm->flush();
                    } else {
                        $dbTags->addPost($this->post);
                        $this->post->addTags($dbTags);
                        $this->dm->persist($dbTags);
                        $this->dm->flush();
                    }
                }



                $archive = new Archives();
                $archivedb = $this->dm->getRepository('MZBlogBundle:Archives')->findOneByDate($archive->getDate());

                if (empty($archive)) {
                    $archive->addPosts($this->post);
                    $this->dm->persist($archive);
                    $this->dm->flush();
                } else {
                    $archivedb->addPosts($this->post);
                    $this->dm->flush();
                }

                $sitemapURL = urlencode('http://www.mlpz.mp/sitemap.xml');
                $pingGoogle = file_get_contents('http://www.google.com/webmasters/tools/ping?sitemap=' . $sitemapURL);
                $this->slug = $this->post->getSlug();
                return true;
            }
        }

        return false;
    }

}

