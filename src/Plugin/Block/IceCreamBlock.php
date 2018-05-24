<?php

namespace Drupal\thomas_more_ice_cream\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\State\StateInterface;
use Drupal\thomas_more_social_media\ClickManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a social menu block.
 *
 * @Block(
 *  id = "thomas_more_social_media_block",
 *  admin_label = @Translation("Social media"),
 * )
 */

class IceCreamBlock {
  protected $clickManager;

  protected $state;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, StateInterface $state, ClickManager $clickManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->clickManager = $clickManager;
    $this->state = $state;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('state'),
      $container->get('thomas_more_social_media.click_manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'social-media',
      '#attached' => ['library' => ['thomas_more_social_media/social_media']],
      '#facebook_url' => $this->state->get('thomas_more_social_media.facebook_url'),
      '#facebook_count' => $this->clickManager->getClicks('facebook'),
      '#google_plus_url' => $this->state->get('thomas_more_social_media.google_plus_url'),
      '#google_plus_count' => $this->clickManager->getClicks('google_plus'),
      '#twitter_url' => $this->state->get('thomas_more_social_media.twitter_url'),
      '#twitter_count' => $this->clickManager->getClicks('twitter'),
      '#linkedin_url' => $this->state->get('thomas_more_social_media.linkedin_url'),
      '#linkedin_count' => $this->clickManager->getClicks('linkedin'),
      '#foursquare_url' => $this->state->get('thomas_more_social_media.foursquare_url'),
      '#foursquare_count' => $this->clickManager->getClicks('foursquare'),

    ];
  }
}