<?php

namespace Drupal\thomas_more_ice_cream\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\thomas_more_ice_cream\DatabaseManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class OptionSettingsForm extends FormBase {

  protected $databaseManager;

  public function __construct(DataBaseManager $databaseManager) {
    $this->databaseManager = $databaseManager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('thomas_more_ice_cream.database_manager')
    );
  }

  public function getFormId() {
    return 'thomas_more_ice_cream_OptionsSettings_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $smaken = $this->databaseManager->getAllSmaken();
    $smakenString = "";
    $toppings = $this->databaseManager->getAllToppings();
    $toppingsString = "";

    $smaakTeller = 0;
    if($smaken != null){
      foreach($smaken as $smaak){

        $smaakTeller++;
        $smakenString .= $smaak;

        if($smaakTeller != count($smaken)){
          $smakenString .= ",\n";
        }
      }
    }

    $toppingTeller = 0;
    if($toppings != null){
      foreach($toppings as $topping){

        $toppingTeller++;
        $toppingsString .= $topping;

        if($toppingTeller != count($smaken)){
          $toppingsString .= ".\n";
        }
      }
    }

    $form['smaken'] = [
      '#type' => 'textarea',
      '#title' => 'Lijst van alle smaken',
      '#default_value' => $smakenString
    ];
    $form['toppings'] = [
      '#type' => 'textarea',
      '#title' => 'Lijst van alle toppings',
      '#default_value' => $toppingsString
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Opslaan',
      '#button_type' => 'primary',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $smakenString = str_replace(' ', '', strtolower($form_state->getValue('smaken')));
    $toppingsString = str_replace(' ', '', strtolower($form_state->getValue('toppings')));

    $smakenNieuw = explode(',', $smakenString);
    $toppingsNieuw = explode(',', $toppingsString);

    $smakenOud = $this->databaseManager->getAllSmaken();
    $toppingsOud = $this->databaseManager->getAllToppings();
    if($smakenOud != null){
      foreach($smakenOud as $smaak){
        $smaak = strtolower($smaak);
      }
    }
    if($toppingsOud != null){
      foreach($toppingsOud as $topping){
        $topping = strtolower($topping);
      }
    }

    if($toppingsNieuw != null){
      foreach($toppingsNieuw as $topping){
        if(in_array($topping, $toppingsOud)){
          unset($toppingsOud[$topping]);
          unset($toppingsNieuw[$topping]);
        }
      }
    }
  }

}