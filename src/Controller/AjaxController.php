<?php

namespace Drupal\thomas_more_ice_cream\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\thomas_more_ice_cream\ClickManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends ControllerBase {

  protected $clickManager;

  public function __construct(ClickManager $clickManager) {
    $this->clickManager = $clickManager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('thomas_more_ice_cream.click_manager')
    );
  }

  public function counter(Request $request) {
      $this->clickManager->addClick($request->get('order'));

    return new Response('Ok');
  }

}
