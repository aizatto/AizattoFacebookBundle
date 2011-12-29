<?php

namespace Aizatto\Bundle\FacebookBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Aizatto\Bundle\FacebookBundle\Entity\Users
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="facebook_users")
 */
class FacebookUser
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
   * @var string $username
   *
   * @ORM\Column(name="username", type="string", length=255, nullable=true)
   */
  protected $username;

  /**
   * @var string $name
   *
   * @ORM\Column(name="name", type="string", length=255, nullable=true)
   */
  protected $name;

  /**
   * @var string $email
   *
   * @ORM\Column(name="email", type="string", length=255, nullable=true)
   */
  protected $email;

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
   * @var string $link
   *
   * @ORM\Column(name="link", type="string", length=255, nullable=true)
   */
  protected $link;

  /**
   * @var bigint $hometown_id
   *
   * @ORM\Column(name="hometown_id", type="bigint", nullable=true)
   */
  protected $hometown_id;

  /**
   * @var string $hometown_name
   *
   * @ORM\Column(name="hometown_name", type="string", length=255, nullable=true)
   */
  protected $hometown_name;

  /**
   * @var bigint $location_id
   *
   * @ORM\Column(name="location_id", type="bigint", nullable=true)
   */
  protected $location_id;

  /**
   * @var string $location_name
   *
   * @ORM\Column(name="location_name", type="string", length=255, nullable=true)
   */
  protected $location_name;

  /**
   * @var string $gender
   *
   * @ORM\Column(name="gender", type="string", length=255, nullable=true)
   */
  protected $gender;

  /**
   * @var string $locale
   *
   * @ORM\Column(name="locale", type="string", length=5, nullable=true)
   */
  protected $locale;

  /**
   * @var string $access_token
   *
   * @ORM\Column(name="access_token", type="string", length=255, nullable=false)
   */
  protected $access_token;

  /**
   * @var datetime $created_At
   *
   * @ORM\Column(name="created_at", type="datetime", nullable=false)
   */
  protected $created_at;

  /**
   * @var datetime $updated_at
   *
   * @ORM\Column(name="updated_at", type="datetime", nullable=false)
   */
  protected $updated_at;

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

  /**
   * @var boolean $verified
   *
   * @ORM\Column(name="verified", type="boolean", nullable=true)
   */
  protected $verified;

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
   * Set email
   *
   * @param string $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
    return $this;
  }

  /**
   * Get email
   *
   * @return string 
   */
  public function getEmail()
  {
    return $this->email;
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
   * Set name
   *
   * @param string $name
   */
  public function setUsername($name)
  {
    $this->username = $name;
    return $this;
  }

  /**
   * Get name
   *
   * @return string 
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set first_name
   *
   * @param string $first_name
   */
  public function setFirstName($first_name)
  {
    $this->first_name = $first_name;
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
   * Set last_Name
   *
   * @param string $last_name
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
   * Set link
   *
   * @param string $link
   */
  public function setLink($link)
  {
    $this->link = $link;
    return $this;
  }

  /**
   * Get link
   *
   * @return string 
   */
  public function getLink()
  {
    return $this->link;
  }

  /**
   * Set hometown_id
   *
   * @param bigint $hometown_id
   */
  public function setHometownID($hometown_id)
  {
    $this->hometown_id = $hometown_id;
    return $this;
  }

  /**
   * Get hometownId
   *
   * @return bigint 
   */
  public function getHometownID()
  {
    return $this->hometown_id;
  }

  /**
   * Set hometownName
   *
   * @param string $hometownName
   */
  public function setHometownName($hometown_name)
  {
    $this->hometown_name = $hometown_name;
    return $this;
  }

  /**
   * Get hometownName
   *
   * @return string 
   */
  public function getHometownName()
  {
    return $this->hometown_name;
  }

  /**
   * Set location_id
   *
   * @param bigint $location_id
   */
  public function setLocationID($location_id)
  {
    $this->location_id = $location_id;
    return $this;
  }

  /**
   * Get location_id
   *
   * @return bigint 
   */
  public function getLocationID()
  {
    return $this->location_id;
  }

  /**
   * Set location_name
   *
   * @param string $location_name
   */
  public function setLocationName($location_name)
  {
    $this->location_name = $location_name;
    return $this;
  }

  /**
   * Get location_name
   *
   * @return string 
   */
  public function getLocationName()
  {
    return $this->location_name;
  }

  /**
   * Set gender
   *
   * @param string $gender
   */
  public function setGender($gender)
  {
    $this->gender = $gender;
    return $this;
  }

  /**
   * Get gender
   *
   * @return string 
   */
  public function getGender()
  {
    return $this->gender;
  }

  /**
   * Set locale
   *
   * @param string $locale
   */
  public function setLocale($locale)
  {
    $this->locale = $locale;
    return $this;
  }

  /**
   * Get locale
   *
   * @return string 
   */
  public function getLocale()
  {
    return $this->locale;
  }

  /**
   * Set access_token
   *
   * @param string $access_token
   */
  public function setAccessToken($access_token)
  {
    $this->access_token = $access_token;
    return $this;
  }

  /**
   * Get access_token
   *
   * @return string 
   */
  public function getAccessToken()
  {
    return $this->access_token;
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
    $this->setUpdatedAt($createdAt);
    $this->created_at = $createdAt;
    return $this;
  }

  /**
   * Get updatedAt
   *
   * @return datetime 
   */
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }

  /**
   * @ORM\prePersist
   * @ORM\preUpdate
   */
  public function setUpdatedAtValue()
  {
    $this->setUpdatedAt(new \DateTime());
    return $this;
  }

  /**
   * Set updatedAt
   *
   * @param datetime $updatedAt
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updated_at = $updatedAt;
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
   * @param boolean $age
   */
  public function setAge($age)
  {
    $this->age = $age;
    return $this;
  }

  /**
   * Get age
   *
   * @return boolean 
   */
  public function getAge()
  {
    return $this->age;
  }

  public function setVerified($verified)
  {
    $this->verified = $verified;
    return $this;
  }

  public function getVerified()
  {
    return $this->verified;
  }

  public function setData($data) {
    $this
      ->setFacebookID(idx($data, 'id'))
      ->setName(idx($data, 'name'))
      ->setFirstName(idx($data, 'first_name'))
      ->setLastName(idx($data, 'last_name'))
      ->setLink(idx($data, 'link'))
      ->setUsername(idx($data, 'username'))
      ->setEmail(idx($data, 'email'))
      ->setGender(idx($data, 'gender'))
      ->setLocale(idx($data, 'locale'))
      ->setVerified(idx($data, 'verified'));

    $hometown = idx($data, 'hometown', array());
    $this
      ->setHometownID(idx($hometown, 'id'))
      ->setHometownName(idx($hometown, 'name'));

    $location = idx($data, 'location', array());
    $this
      ->setLocationID(idx($location, 'id'))
      ->setLocationName(idx($location, 'name'));

    if (idx($data, 'birthday')) {
      $birthday = DateTime::createFromFormat('m/d/Y', $data['birthday']);
      $this
        ->setBirthday($birthday)
        ->setAge(id(new DateTime())->diff($birthday)->y);
    }

    return $this;
  }

}
