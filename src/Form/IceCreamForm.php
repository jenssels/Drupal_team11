<?php
namespace Drupal\thomas_more_ice_cream\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Drupal\thomas_more_ice_cream\DatabaseManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IceCreamForm extends FormBase {
  protected $databaseManager;
  public function __construct(DatabaseManager $databaseManager) {
    $this->databaseManager = $databaseManager;
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('thomas_more_ice_cream.database_manager')
    );
  }

  public function getFormId() {
    return 'thomas_more_ice_cream_ice_cream_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['choice'] = array(
      '#type' => 'radios',
      '#title' => 'Select Ice Cream or Waffle',
      '#options' => array(
        'icecream' => 'Ice Cream',
        'waffle' => 'Waffle',
      )
    );

    $smaakdata = [];
    foreach($this->databaseManager->getAllSmaken() as $smaak){
      $smaakdata[$smaak] = $smaak;
        }

    $form['smaak'] = array(
      '#type' => 'radios',
      '#title' => 'Select flavor',
      '#options' => $smaakdata
    );

    $toppingdata = [];
    foreach($this->databaseManager->getAllToppings() as $topping){
      $toppingdata[$topping] = $topping;
    }

    $form['topping'] = [
      '#type' => 'checkboxes',
      '#title' => 'Select toppings',
      '#options' => $toppingdata
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
      '#button_type' => 'primary',
    ];
    return $form;

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('choice')=='icecream'){
      $checksmaak = $this->databaseManager->addSmaakKeuze($form_state->getValue('smaak'));
      if ($checksmaak==True){
        drupal_set_message('Threshold Ice Cream reached!');
      }
      else{
        drupal_set_message('Threshold Ice Cream not yet reached!');
      }
    };

    if ($form_state->getValue('choice')=='waffle'){
      $checktopping = $this->databaseManager->addToppingKeuze($form_state->getValue('topping'));
      if ($checktopping==True){
        drupal_set_message('Threshold Waffles reached!');
      }
      else{
        drupal_set_message('Threshold Waffles not yet reached!');
      }
    };

    drupal_set_message('Smaak of Topping doorgegeven');
  }

}