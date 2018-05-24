<?php
/**
 * Created by PhpStorm.
 * User: drupal8
 * Date: 24/05/18
 * Time: 9:41
 */

namespace Drupal\thomas_more_ice_cream;




use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DatabaseManager {
  protected $database;
  protected $datetime;
  protected $state;
  public function __construct(StateInterface $state, Connection $database, TimeInterface $datetime) {
    $this->database = $database;
    $this->datetime = $datetime;
    $this->state = $state;
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('state'),
      $container->get('datetime.time')
    );
  }

  public function addSmaak($smaak){
    $this->database->insert('thomas_more_ice_cream_smaak')->fields(['smaak' => $smaak, 'time_clicked' => $this->datetime->getRequestTime()])->execute();
    $ijsTeller = $this->state->get('thomas_more_ice_cream.ijsTeller');
    $ijsThreshold = $this->state->get('thomas_more_ice_cream.ijsjes_threshold');
    $ijsTeller++;
    if($ijsTeller >= $ijsThreshold){
      $this->resetIjsTeller();
      return true;
    }
    else{
      $this->state->set('thomas_more_ice_cream.ijsTeller', $ijsTeller);
      return false;
    }

  }

  public function addTopping($topping){
    $this->database->insert('thomas_more_ice_cream_toppings')->fields(['topping' => $topping, 'time_clicked' => $this->datetime->getRequestTime()])->execute();
    $wafelTeller = $this->state->get('thomas_more_ice_cream.wafelTeller');
    $wafelThreshold = $this->state->get('thomas_more_ice_cream.wafels_threshold');
    $wafelTeller++;
    if ($wafelTeller >= $wafelThreshold){
      $this->resetWafelTeller();
      return true;
    }
    else{
      $this->state->set('thomas_more_ice_cream.wafelTeller', $wafelTeller);
      return false;
    }

  }

  public function resetIjsTeller(){
    $ijsTeller = 0;
    $this->state->set('thomas_more_ice_cream.ijsTeller', $ijsTeller);
  }

  public function resetWafelTeller(){
    $wafelTeller = 0;
    $this->state->set('thomas_more_ice_cream.wafelTeller', $wafelTeller);
  }


}