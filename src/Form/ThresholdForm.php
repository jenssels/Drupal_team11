<?php

namespace Drupal\thomas_more_ice_cream\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ThresholdForm extends FormBase {

  protected $state;

  public function __construct(StateInterface $state) {
    $this->state = $state;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('state')
    );
  }

  public function getFormId() {
    return 'thomas_more_ice_cream_settings_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['ijsjes_threshold'] = [
      '#type' => 'number',
      '#title' => 'Threshold voor de ijsjes.',
      '#default_value' => $this->state->get('thomas_more_ice_cream.ijsjes_threshold'),
    ];

    $form['wafels_threshold'] = [
      '#type' => 'number',
      '#title' => 'Threshold voor de wafels.',
      '#default_value' => $this->state->get('thomas_more_ice_cream.wafels_threshold'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Opslaan',
      '#button_type' => 'primary',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->state->set('thomas_more_ice_cream.ijsjes_threshold', $form_state->getValue('ijsjes_threshold'));
    $this->state->set('thomas_more_ice_cream.wafels_threshold', $form_state->getValue('wafels_threshold'));
    drupal_set_message('De threshold waardes zijn succesvol opgeslagen');
  }
}