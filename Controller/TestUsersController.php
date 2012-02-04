<?php

namespace Aizatto\Bundle\FacebookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * https://developers.facebook.com/docs/test_users/
 */
class TestUsersController extends Controller
{

  CONST
    APC_KEY = 'facebook:test-users',
    APC_CREATED_AT_KEY = 'facebook:test-users:created-at';

  public function indexAction() {
    $success1 = $success2 = false;
    $users = apc_fetch(self::APC_KEY, $success1);
    $created_at = apc_fetch(self::APC_CREATED_AT_KEY, $success2);

    if (!$success1 || !$success2) {
      $users = $this->fetchTestUsers();
      $created_at = time();
      apc_store(self::APC_KEY, $users, 600);
      apc_store(self::APC_CREATED_AT_KEY, $created_at);
    }

    $content = $this->renderView(
      'AizattoFacebookBundle:TestUsers:index.html.php',
      array(
        'users' => $users,
        'created_at' => $created_at,
      )
    );
    return new Response($content);
  }

  public function fetchTestUsers() {
    $facebook = $this->get('facebook');
    $app_id = $facebook->getAppID();
    $access_token = $app_id.'|'.$facebook->getApiSecret();
    $query = array('access_token' => $access_token);
    $data = $facebook->api($app_id.'/accounts/test-users', 'GET', $query);

    $users = array();
    $batch = array();
    foreach ($data['data'] as $user) {
      $query = '';
      if (isset($user['access_token'])) {
        $query = '?access_token='.$user['access_token'];
      }

      $users[$user['id']] = $user;
      $batch[] = array(
        'method' => 'GET',
        'relative_url' => $user['id'].$query
      );
    }

    // facebook allows you to batch 20 requests at a time
    $batches = array_chunk($batch, 20);
    foreach ($batches as $batch) {
      $responses = $this->get('facebook')->api(
        '',
        'POST',
        array('batch' => $batch));
      
      foreach ($responses as $response) {
        if ($response['code'] != 200) {
          continue;
        }

        $json = json_decode($response['body'], true);
        $id = $json['id'];
        if (!isset($users[$id])) {
          continue;
        }
        $users[$id] = array_merge($users[$id], $json);
      }
    }

    return $users;
  }

}
