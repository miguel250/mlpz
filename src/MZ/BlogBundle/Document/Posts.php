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
	 * @Gedmo:Sluggable
	 * @MongoDB\String
	 */
	private $title;
	
	/**
	 * @MongoDB\Index 
	 * @MongoDB\String
	 */
	private $slug;

	/**
	 * @MongoDB\String
	 */
	private $type;

	/**
	 * @MongoDB\String
	 */
	private $body;
	
	/**
	 * @MongoDB\Collection
	 */
	private $tags;

	/**
	 * @MongoDB\date
	 */
	private $createdAt;


	public function __construct()
	{
		$this->createdAt = new DateTime();
		$this->tags = new ArrayCollection();
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
     * Set tags
     *
     * @param string $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get tags
     *
     * @return string $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get createdAt
     *
     * @return timestamp $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}