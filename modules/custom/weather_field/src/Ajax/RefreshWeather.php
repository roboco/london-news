<?php

namespace Drupal\weather_field\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Class RefreshWeather.
 */
class RefreshWeather implements CommandInterface {

  /**
   * Render custom ajax command.
   *
   * @return ajax
   *   Command function.
   */
  public function render() {
    return [
      'command' => 'refreshWeather',
      'message' => 'My Awesome Message',
    ];
  }

}
