<?php

namespace Aizatto\Bundle\FacebookBundle\Security;

use BaseFacebook;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Http\Logout\SessionLogoutHandler;

class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{

  public function __construct(BaseFacebook $facebook) {
    $this->facebook = $facebook;
  }

  public function onLogoutSuccess(Request $request) {
    $this->facebook->destroySession();

    if (isset($_SERVER['HTTP_REFERER'])) {
      $url = $_SERVER['HTTP_REFERER'];
    } else {
      $url = $request->getBaseURL();
    }

    $cookie_name = 'fbsr_'.$this->facebook->getAppID();

    $response = new RedirectResponse($url, 302);
    $response->headers->setCookie(new Cookie($cookie_name));
    return $response;
  }

}
