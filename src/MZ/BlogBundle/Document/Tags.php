<?php

namespace MZ\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @MongoDB\Document
 */
class Tags
{

    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @Mongodb\string
     */
    private $name;

    /**
     * @MongoDB\Index(background=true)
     * @Mongodb\string
     */
    private $slug;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Posts")
     */
    private $post = array();

    public function __construct()
    {
        $this->post = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->setSlug($name);
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add post
     *
     * @param MZ\BlogBundle\Document\Posts $post
     */
    public function addPost(\MZ\BlogBundle\Document\Posts $post)
    {
        $this->post[] = $post;
    }

    /**
     * Get post
     *
     * @return Doctrine\Common\Collections\Collection $post
     */
    public function getPost()
    {
        return $this->post;
    }

    public function removePost($id)
    {
        $key = array_search($id, get_object_vars($this->getPost()));
        unset($this->post[$key]);
    }

    /**
     * Get Slug
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $slug = preg_replace('/\W+/', '-', $slug);
        $slug = strtolower(trim($slug, '-'));
        $this->slug = $slug;
    }

}