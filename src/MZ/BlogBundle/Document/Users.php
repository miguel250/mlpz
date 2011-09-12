<?php

namespace MZ\BlogBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Users extends BaseUser
{

    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

}
