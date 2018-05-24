<?php
namespace Drupal\thomas_more_ice_cream\Form;


class IceCreamForm extends FormBase {
  protected $clickManager;
  public function __construct(ClickManager $clickManager) {
    $this->clickManager = $clickManager;
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('thomas_more_ice_cream.click_manager')
    );
  }

  public function getFormId() {
    return 'thomas_more_ice_cream_ice_cream_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['annotate_deletion'] = array(
      '#type' => 'radios',
      '#title' => 'Select Ice Cream or Waffle',
      '#options' => array(
        'Ice Cream',
        'Waffle',
      )
    );

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Reset',
      '#button_type' => 'primary',
    ];
    return $form;
  }

}