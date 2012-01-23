<?php

namespace Aizatto\Bundle\FacebookBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Core\SecurityContext;

class FacebookController extends Controller
{

  /**
   * @Route("/channel", name="facebook_channel")
   */
  public function channelAction()
  {
    $expires = 60*60*24*365;
    $response = new Response('<script src="//connect.facebook.net/en_US/all.js"></script>');
    $response->setMaxAge($expires);
    $response->setExpires(new \DateTime($expires));
    $response->setPublic();
    return $response;
  }

  /**
   * TODO ensure that the referer is coming from the same domain
   * @Route("/login", name="facebook_login")
   */
  public function loginAction()
  {
    if (isset($_SERVER['HTTP_REFERER'])) {
      $url = $_SERVER['HTTP_REFERER'];
    } else {
      $url = $this->getRequest()->getBaseURL();
    }

    return new RedirectResponse($url, 302);
  }

  /**
   * @Route("/login/check", name="facebook_login_check")
   */
  public function loginCheckAction()
  {
    $facebook = $this->get('facebook');
  }

  /**
   * TODO ensure that the referer is coming from the same domain
   * @Route("/logout", name="facebook_logout")
   */
  public function logoutAction()
  {
    $facebook = $this->get('facebook');
    $facebook->destroySession();
    $cookie_name = 'fbsr_'.$facebook->getAppID();

    $session = $this->getRequest()->getSession();
    $session->clear();
    $session->save();
    $session->close();

    if (isset($_SERVER['HTTP_REFERER'])) {
      $url = $_SERVER['HTTP_REFERER'];
    } else {
      $url = $this->getRequest()->getBaseURL();
    }

    $response = new RedirectResponse($url, 302);
    $response->headers->setCookie(new Cookie($cookie_name));

    return $response;
  }

}
