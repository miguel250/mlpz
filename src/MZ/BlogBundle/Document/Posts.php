<?php

namespace MZ\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * @MongoDB\Document
 */
class Posts
{
	/**
	 * @MongoDB\Id(strategy="auto")
	 */
	private $id;

	/**
	 * @MongoDB\String
	 */
	private $title;
	
	/**
	 * @MongoDB\Index(background=true)
	 * @MongoDB\String
	 */
	private $slug;

	/**
	 * @MongoDB\String
	 */
	private $username;
	
	/**
	 * @MongoDB\String
	 */
	private $type;

	/**
	 * @MongoDB\String
	 */
	private $body;
	
	/**
	 * @MongoDB\ReferenceMany(targetDocument="Tags", cascade="all")
	 */
	private $tags = array();

	/**
	 * @MongoDB\date
	 */
	private $createdAt;


	public function __construct()
	{
		$this->createdAt = new DateTime();
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
    	$this->setSlug($title);
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
    	$slug = preg_replace('/\W+/', '-', $slug);
    	$slug = strtolower(trim($slug, '-'));
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set body
     *
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return string $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Add tags
     *
     * @param MZ\BlogBundle\Document\Tags $tags
     */
    public function addTags(\MZ\BlogBundle\Document\Tags $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

}