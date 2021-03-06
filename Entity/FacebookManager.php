<?php

namespace Aizatto\Bundle\FacebookBundle\Entity;

use Aizatto\Bundle\FacebookBundle\Entity\FacebookUser;
use Aizatto\Bundle\FacebookBundle\Entity\FacebookFriend;
use BaseFacebook;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Monolog\Logger;

class FacebookManager {

  protected
    $em,
    $facebook_class,
    $logger,
    $facebook_user_class,
    $facebook_friend_class;

  public function __construct(BaseFacebook $facebook,
                              EntityManager $em,
                              Logger $logger,
                              $facebook_user_class,
                              $facebook_friend_class) {
    $this->em = $em;
    $this->facebook = $facebook;
    $this->logger = $logger;
    $this->facebook_user_class = $facebook_user_class;
    $this->facebook_friend_class = $facebook_friend_class;
  }

  public function updateFacebookUser(FacebookUser $facebook_user) {
    $this->updateFacebookUserThroughAPI($facebook_user);
    $this->updateFacebookUserThroughFQL($facebook_user);
  }

  public function updateFacebookUserThroughAPI(FacebookUser $facebook_user) {
    $data = $this->facebook->api('/me', array(
      'access_token' => $facebook_user->getAccessToken(),
    ));
    $facebook_user->setDataFromAPI($data);
  }

  public function updateFacebookUserThroughFQL(FacebookUser $facebook_user) {
    $fql = $this->getUserFQL("uid = me()");
    $data = $this->facebook->api('/fql', array(
      'q' => $fql,
      'access_token' => $facebook_user->getAccessToken(),
    ));
    $facebook_user->setDataFromFQL($data['data'][0]);
  }

  /**
   * https://developers.facebook.com/docs/reference/fql/user/
   */
  public function updateFriends(User $user) {
    $facebook_id = $user->getFacebookID();
    if (!$facebook_id) {
      return;
    }

    $data = $this->em
      ->getRepository($this->facebook_user_class)
      ->findOneBy(array('facebook_id' => $facebook_id));

    try {
      $fql = $this->getUserFQL("uid IN (SELECT uid2 FROM friend WHERE uid1 = me())");
      $data = $this->facebook->api('/fql', array(
        'q' => $fql,
        'access_token' => $data->getAccessToken(),
      ));
    } catch (\FacebookApiException $e) {
      $this->logger->err($e->getMessage());
      return;
    }

    if ($data['data']) {
      $query = $this->em
        ->getRepository($this->facebook_user_class)
        ->createQueryBuilder('u')
        ->where('u.facebook_id IN (:ids)')
        ->setParameter('ids', ipull($data['data'], 'uid'))
        ->getQuery();

      $facebook_users = $query->getResult();
      $facebook_users = mpull($facebook_users, null, 'getFacebookID');

      foreach ($data['data'] as $friend) {
        $uid = $friend['uid'];

        if (isset($facebook_users[$uid])) {
          $facebook_user = $facebook_users[$uid];
        } else {
          $facebook_users[$uid] = $facebook_user =
            newv($this->facebook_user_class, array());
        }
        $facebook_user->setDataFromFQL($friend);
        $this->em->persist($facebook_user);
      }
    } else {
      $facebook_users = array();
    }

    $friends = $this->em
      ->getRepository($this->facebook_friend_class)
      ->findBy(array('facebook_id' => $facebook_id));

    $friends = mpull($friends, null, 'getFriendID');

    $remove = array_diff_key($friends, $facebook_users);
    $add = array_diff_key($facebook_users, $friends);

    foreach ($remove as $friend) {
      $this->em->remove($friend);
      unset($facebook_users[$friend->getFacebookID()]);
    }

    foreach ($add as $facebook_user) {
      $friend = newv($this->facebook_friend_class, array())
        ->setFacebookID($facebook_id)
        ->setFriendID($facebook_user->getFacebookID());
      $this->em->persist($friend);
      $friends[$facebook_user->getFacebookID()] = $facebook_user;
    }

    $user->setUpdatedFacebookAt(new \Datetime());
    $this->em->persist($user);
    $this->em->flush();
    return $facebook_users;
  }

  private function getUserFQL($conditions) {
    return <<<SQL
      SELECT
        uid, name, first_name, middle_name, last_name, username, birthday_date,
        sex, locale, current_location, hometown_location, profile_url, verified,
        pic, pic_small, pic_big, pic_square
      FROM user
      WHERE {$conditions}
SQL;
  }

}
