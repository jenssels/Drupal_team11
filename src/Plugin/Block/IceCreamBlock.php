<?php

namespace Drupal\thomas_more_ice_cream\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines an ice cream menu block.
 *
 * @Block(
 *  id = "thomas_more_ice_cream_block",
 *  admin_label = @Translation("Ice cream"),
 * )
 */
class IceCreamBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $form = \Drupal::formBuilder()
      ->getForm('Drupal\thomas_more_ice_cream\Form\IceCreamForm');

    return $form;
  }


}