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
        'Ice Cream',
        'Waffle',
      )
    );

    $form['smaak'] = array(
      '#type' => 'radios',
      '#title' => 'Select flavor',
      '#options' => array(
        'vanilla' => 'Vanilla',
        'strawberry' => 'Strawberry',
        'chocolate' => 'Chocolate',
        'mokka' => 'Mokka',
        'banana' => 'Banana',
      )
    );

    $form['topping'] = [
      '#type' => 'checkboxes',
      '#options' => [
        'whippedCream' => 'Whipped Cream',
        'chocolatesprinkle' => 'Chocolate Sprinkles',
        'strawberries' => 'Strawberries',
      ]
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
      '#button_type' => 'primary',
    ];
    return $form;

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->databaseManager->addSmaak($form_state->get('smaak'));
    $this->databaseManager->addTopping($form_state->get('topping'));

    drupal_set_message('Test');
  }

}