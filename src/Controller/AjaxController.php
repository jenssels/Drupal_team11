<?php

namespace Drupal\thomas_more_ice_cream\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\thomas_more_social_media\ClickManager;
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
      $container->get('thomas_more_social_media.click_manager')
    );
  }

  public function counter(Request $request) {
    if (!$this->currentUser()->hasPermission('skip tracking clicks')) {
      $this->clickManager->addClick($request->get('network'));
    }

    return new Response('Ok');
  }

}
