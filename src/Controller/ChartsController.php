<?php
/**
 * Created by PhpStorm.
 * User: drupal8
 * Date: 24/05/18
 * Time: 11:23
 */

namespace Drupal\thomas_more_ice_cream\Controller;


use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Controller\ControllerBase;
use Drupal\thomas_more_ice_cream\DatabaseManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ChartsController extends ControllerBase {
  protected $databaseManager;
  public function __construct(DataBaseManager $databaseManager) {
    $this->databaseManager = $databaseManager;
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('thomas_more_ice_cream.database_manager')
    );
  }

  public function buildCharts(){
    $toppings = $this->databaseManager->getAllToppings();
    $toppingData[] = ['Wafel Toppings', 'Aantal'];
    foreach($toppings as $topping){
      $toppingData[] = [$topping, $this->databaseManager->getCountTopping($topping)];
    }

    $smaken = $this->databaseManager->getAllSmaken();
    $smaakData[] = ['Ice cream smaken', 'Aantal'];
    foreach($smaken as $smaak){
      $smaakData[] = [$smaak, $this->databaseManager->getCountSmaak($smaak)];
    }

    $chart['smaken'] = [
      '#markup' => new FormattableMarkup('<div id="ijs" style="width: 900px; height: 500px;">Smaak chart.</div>', []),
      '#attached' => [
        'library' => ['thomas_more_ice_cream/data_charts'],
        'drupalSettings' => [
          'chart_smaken' =>
            $smaakData
          ,
        ],
      ],
    ];

    $chart['toppings'] = [
      '#markup' => new FormattableMarkup('<div id="wafel" style="width: 900px; height: 500px;">Topping chart.</div>', []),
      '#attached' => [
        'library' => ['thomas_more_ice_cream/data_charts'],
        'drupalSettings' => [
          'chart_toppings' => $toppingData,

        ],
      ],
    ];
    return $chart;
  }


}