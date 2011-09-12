<?php

namespace MZ\BlogBundle\Form\Handler;

use MZ\BlogBundle\Document\Posts;
use MZ\BlogBundle\Document\Tags;
use MZ\BlogBundle\Document\Archives;

class EditFormHandler
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

                $tagsArray = explode(",", strtolower($this->post->getTagString()));
                $postTags = $this->post->getTags();

                $this->post->removeTags();

                $this->dm->flush();

                foreach ($postTags as $tag) {
                    $removeTags = $this->dm->getRepository('MZBlogBundle:Tags')->findOneByName($tag->getName());
                    $removeTags->removePost($this->post->getId());
                    $this->dm->flush();
                }

                foreach ($tagsArray as $tag) {
                    $tags = new Tags();
                    $tag = trim($tag);
                    $dbTags = $this->dm->getRepository('MZBlogBundle:Tags')->findOneByName($tag);

                    if (empty($dbTags)) {
                        $tags->setName($tag);
                        $tags->addPost($this->post);
                        $this->post->addTags($tags);
                        $this->dm->flush();
                    } else {

                        $this->dm->flush();
                        $dbTags->addPost($this->post);
                        $this->post->addTags($dbTags);
                        $this->dm->flush();
                    }
                }

                $archive = new Archives();
                $archive->addPosts($this->post);
                $this->dm->flush();

                $this->slug = $this->post->getSlug();
                return true;
            }
        }

        return false;
    }

}

