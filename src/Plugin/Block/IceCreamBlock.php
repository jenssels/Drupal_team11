<?php

namespace Drupal\thomas_more_ice_cream\Plugin\Block;

use Drupal\Core\Block\BlockBase;
//use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
//use Drupal\Core\State\StateInterface;
//use Drupal\thomas_more_ice_cream\DatabaseManager;
//use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines an ice cream menu block.
 *
 * @Block(
 *  id = "thomas_more_ice_cream_block",
 *  admin_label = @Translation("Ice cream"),
 * )
 */

class IceCreamBlock extends BlockBase {
//  protected $databaseManager;
//
//  protected $state;
//
//  public function __construct(array $configuration, $plugin_id, $plugin_definition, StateInterface $state, DatabaseManager $databaseManager) {
//    parent::__construct($configuration, $plugin_id, $plugin_definition);
//
//    $this->databaseManager = $databaseManager;
//    $this->state = $state;
//  }
//
//  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
//    return new static(
//      $configuration,
//      $plugin_id,
//      $plugin_definition,
//      $container->get('state'),
//      $container->get('thomas_more_ice_cream.database_manager')
//    );
//  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'social-media',
//      '#attached' => ['library' => ['thomas_more_ice_cream/ice_cream']],
//      '#ice_cream_tastes' => $this->state->get('thomas_more_ice_cream.ice_cream_tastes'),
//      '#ice_cream_count' => $this->clickManager->getClicks('ice_cream'),
//      '#waffle_toppings' => $this->state->get('thomas_more_ice_cream.waffle_toppings'),
//      '#waffle_count' => $this->clickManager->getClicks('waffle'),
    ];
  }


}