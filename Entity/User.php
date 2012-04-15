<?php

namespace Aizatto\Bundle\FacebookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Aizatto\Bundle\FacebookBundle\Entity\User;
 *
 * @ORM\HasLifecycleCallbacks()
 */
abstract class User extends BaseUser
{

  const ROLE_FACEBOOK = 'ROLE_FACEBOOK';

  /**
   * @var integer $facebook_id
   *
   * @ORM\Column(name="facebook_id", type="bigint", nullable=true)
   */
  protected $facebook_id;

  /**
   * @var DateTime $created_at
   *
   * @ORM\Column(name="created_at", type="datetime")
   */
  protected $created_at;

  /**
   * @var Datetime $updated_at
   *
   * @ORM\Column(name="updated_at", type="datetime")
   */
  protected $updated_at;

  /**
   * @var string $name
   *
   * @ORM\Column(name="name", type="string", length=255, nullable=true)
   */
  protected $name;

  /**
   * @var string $first_name
   *
   * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
   */
  protected $first_name;

  /**
   * @var string $last_name
   *
   * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
   */
  protected $last_name;


  /**
   * @var date $birthday
   *
   * @ORM\Column(name="birthday", type="date", nullable=true)
   */
  protected $birthday;

  /**
   * @var integer $age
   *
   * @ORM\Column(name="age", type="integer", nullable=true)
   */
  protected $age;

  public function setPassword($value) {
    parent::setPassword($value);
    return $this;
  }

  public function setUsername($value) {
    parent::setUsername($value);
    return $this;
  }

  public function setEmail($value) {
    parent::setEmail($value);
    return $this;
  }

  public function setEnabled($value) {
    parent::setEnabled($value);
    return $this;
  }

  /**
   * Set facebook_id
   *
   * @param bigint $facebookId
   */
  public function setFacebookID($facebookId)
  {
    $this->facebook_id = $facebookId;
    return $this;
  }

  /**
   * Get facebook_id
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
   * Set created_at
   *
   * @param datetime $createdAt
   */
  public function setCreatedAt($createdAt)
  {
    $this->created_at = $createdAt;
    return $this;
  }

  /**
   * Get created_at
   *
   * @return datetime 
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * @ORM\preUpdate
   */
  public function setUpdatedAtValue()
  {
    $this->setUpdatedAt(new \DateTime());
    return $this;
  }

  /**
   * Set updated_at
   *
   * @param datetime $updatedAt
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updated_at = $updatedAt;
    return $this;
  }

  /**
   * Get updated_at
   *
   * @return datetime 
   */
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }

  /**
   * Set name
   *
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
    return $this;
  }

  /**
   * Get name
   *
   * @return string 
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set first_name
   *
   * @param string $firstName
   */
  public function setFirstName($firstName)
  {
    $this->first_name = $firstName;
    return $this;
  }

  /**
   * Get first_name
   *
   * @return string 
   */
  public function getFirstName()
  {
    return $this->first_name;
  }

  /**
   * Set last_name
   *
   * @param string $lastName
   */
  public function setLastName($last_name)
  {
    $this->last_name = $last_name;
    return $this;
  }

  /**
   * Get last_name
   *
   * @return string 
   */
  public function getLastName()
  {
    return $this->last_name;
  }

  /**
   * Set birthday
   *
   * @param date $birthday
   */
  public function setBirthday($birthday)
  {
    $this->birthday = $birthday;
    return $this;
  }

  /**
   * Get birthday
   *
   * @return date 
   */
  public function getBirthday()
  {
    return $this->birthday;
  }

  /**
   * Set age
   *
   * @param integer $age
   */
  public function setAge($age)
  {
    $this->age = $age;
    return $this;
  }

  /**
   * Get age
   *
   * @return integer 
   */
  public function getAge()
  {
    return $this->age;
  }

  /**
   * Serializes the user.
   *
   * The serialized data have to contain the fields used by the equals method and the username.
   *
   * @return string
   */
  public function serialize()
  {
    return serialize(array(
      $this->password,
      $this->salt,
      $this->usernameCanonical,
      $this->username,
      $this->expired,
      $this->locked,
      $this->credentialsExpired,
      $this->enabled,
      $this->facebook_id,
    ));
  }

  /**
   * Unserializes the user.
   *
   * @param string $serialized
   */
  public function unserialize($serialized)
  {
    list(
      $this->password,
      $this->salt,
      $this->usernameCanonical,
      $this->username,
      $this->expired,
      $this->locked,
      $this->credentialsExpired,
      $this->enabled,
      $this->facebook_id,
    ) = unserialize($serialized);
  }

}
