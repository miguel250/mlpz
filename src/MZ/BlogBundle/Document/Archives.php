<?php

namespace MZ\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @MongoDB\Document
 */
class Archives
{

    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @MongoDB\Index(background=true, order="desc")
     * @Mongodb\string
     */
    private $date;

    /**
     *  @MongoDB\EmbedMany
     */
    private $posts = array();

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $date = date("F Y");
        $this->date = strtoupper($date);
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
     * Get date
     *
     * @return string $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add posts
     *
     * @param $posts
     */
    public function addPosts($posts)
    {
        $this->posts[] = $posts;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }

}