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
      $container->get('thomas_more_social_media.database_manager')
    );
  }

  public function buildCharts(){
    $smaken = $this->databaseManager->getAllSmaken();
    $smaakData = '';
    foreach($smaken as $smaak){
      $smaakData .= "['" . $smaak['smaak'] . "' => " . $this->databaseManager->getCountSmaak($smaak['smaak']) . "]";
    }

    $chart['smaken'] = [
      '#markup' => new FormattableMarkup('<div id="chart" style="width: 900px; height: 500px;">Smaak chart.</div>', []),
      '#attached' => [
        'library' => ['thomas_more_social_media/ice_cream'],
        'drupalSettings' => [
          'chart_data' => [
            $smaakData
          ],
        ],
      ],
    ];

    $chart['toppings'] = [
      '#markup' => new FormattableMarkup('<div id="chart" style="width: 900px; height: 500px;">Chart will be displayed here.</div>', []),
      '#attached' => [
        'library' => ['thomas_more_social_media/ice_cream'],
        'drupalSettings' => [
          'chart_data' => [
          ]
        ],
      ],
    ];
  }

}