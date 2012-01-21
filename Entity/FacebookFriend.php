<?php

namespace Aizatto\Bundle\FacebookBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Aizatto\Bundle\FacebookBundle\Entity\Users
 */
abstract class FacebookFriend
{

  /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @var bigint $facebook_id
   *
   * @ORM\Column(name="facebook_id", type="bigint", nullable=false)
   */
  protected $facebook_id;

  /**
   * @var bigint $friend_id
   *
   * @ORM\Column(name="friend_id", type="bigint", nullable=false)
   */
  protected $friend_id;

  /**
   * @var datetime $created_At
   *
   * @ORM\Column(name="created_at", type="datetime", nullable=false)
   */
  protected $created_at;

  /**
   * Get id
   *
   * @return integer 
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set facebook_id
   *
   * @param bigint $facebook_id
   */
  public function setFacebookID($facebook_id)
  {
    $this->facebook_id = $facebook_id;
    return $this;
  }

  /**
   * Get facebookId
   *
   * @return bigint 
   */
  public function getFacebookID()
  {
    return $this->facebook_id;
  }

  /**
   * @ORM\prePersist
   */
  public function setCreatedAtValue()
  {
    $this->setCreatedAt(new \DateTime());
    return $this;
  }

  /**
   * Set createdAt
   *
   * @param datetime $createdAt
   */
  public function setCreatedAt($createdAt)
  {
    $this->created_at = $createdAt;
    return $this;
  }

  /**
   * Get createdAt
   *
   * @return datetime 
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set friend_id
   *
   * @param bigint $friendId
   */
  public function setFriendID($friendId)
  {
    $this->friend_id = $friendId;
    return $this;
  }

  /**
   * Get friend_id
   *
   * @return bigint 
   */
  public function getFriendID()
  {
    return $this->friend_id;
  }

}
