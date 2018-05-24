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
use Symfony\Component\DependencyInjection\ContainerInterface;

class DatabaseManager {
  protected $database;
  protected $datetime;
  public function __construct(Connection $database, TimeInterface $datetime) {
    $this->database = $database;
    $this->datetime = $datetime;
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('datetime.time')
    );
  }


}