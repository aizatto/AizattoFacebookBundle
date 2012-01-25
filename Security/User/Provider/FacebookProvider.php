<?php

namespace Aizatto\Bundle\FacebookBundle\Security\User\Provider;

use Aizatto\Bundle\FacebookBundle\Entity\FacebookManager;
use BaseFacebook;
use FacebookApiException;
use Doctrine\ORM\EntityManager;
use FOS\FacebookBundle\Security\User\UserManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class FacebookProvider implements UserManagerInterface
{

  protected
    $facebook,
    $em,
    $facebook_manager,
    $user_class,
    $facebook_user_class,
    $debug;

  public function __construct(BaseFacebook $facebook,
                              EntityManager $em,
                              FacebookManager $facebook_manager,
                              $user_class,
                              $facebook_user_class, 
                              $debug) {
    $this->facebook = $facebook;
    $this->em = $em;
    $this->user_class = $user_class;
    $this->facebook_manager = $facebook_manager;
    $this->facebook_user_class = $facebook_user_class;
    $this->debug;
  }

  public function supportsClass($class) {
    return $class == $this->user_class;
  }

  /**
   * When logging in via Facebook Connect, this represents the user id.
   * When logging in via Remember me, this is the username
   *
   * I guess this bug is caused by FOSFacebook expecting that the
   * username == facebook id
   */
  public function loadUserByUsername($username) {
    $user = $this->em
      ->getRepository($this->user_class)
      ->findOneBy(array('username' => $username));

    if (preg_match('/^\d+$/', (string) $username)) {
      $user = $this->loadUserByFacebookID($username);
    }

    if (!$user) {
      throw new UsernameNotFoundException(
        sprintf('Unable to find username %s', $username));
    }

    return $user;
  }

  public function loadUserByFacebookID($facebook_id) {
    return $this->em
      ->getRepository($this->user_class)
      ->findOneBy(array('facebook_id' => $facebook_id));
  }

  /**
   * TODO add logging of how user was created, php session id, ip address
   */
  public function createUserFromUid($facebook_id) {
    try {
      $fbuser = $this->em
        ->getRepository($this->facebook_user_class)
        ->findOneBy(array('facebook_id' => $facebook_id));

      if (!$fbuser) {
        $fbuser = newv($this->facebook_user_class);
      }
      
      $fbuser->setAccessToken($this->facebook->getAccessToken());
      $this->facebook_manager->updateFacebookUser($fbuser);

      $user = id(new User())
        ->setPassword('')
        ->setUsername($fbuser->getUsername() ?: '')
        ->setEmail($fbuser->getEmail())
        ->setName($fbuser->getName())
        ->setFirstName($fbuser->getFirstName())
        ->setLastName($fbuser->getLastName())
        ->setBirthday($fbuser->getBirthday())
        ->setAge($fbuser->getAge())
        ->setEnabled(true)
        ->setFacebookID($fbuser->getFacebookID());

      $user->addRole('ROLE_FACEBOOK');
      $user->addRole('ROLE_USER');

      $this->em->persist($user);
      $this->em->persist($fbuser);
      $this->em->flush();
      return $user;
    } catch (\Exception $e) {
      if (true || $this->debug) {
      }

        var_dump(__FILE__);
        exit();
      throw $e;
    }

  }

  /**
   * TODO support login through non Facebook
   */
  public function refreshUser(UserInterface $user) {
    if (!$this->supportsClass(get_class($user))) {
      throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
    }

    if (!$user->getFacebookID()) {
      throw new UsernameNotFoundException('Unable to find facebook id');
    }

    $user = $this->loadUserByFacebookID($user->getFacebookID());

    return $user;
  }
}
