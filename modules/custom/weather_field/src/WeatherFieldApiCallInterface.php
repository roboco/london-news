<?php

namespace Drupal\weather_field;

/**
 * Interface WeatherFieldApiCallInterface.
 */
interface WeatherFieldApiCallInterface {

  /**
   * @param mixed $num_days
   */
  public function setNumDays($num_days);

  /**
   * @param mixed $time_interval
   */
  public function setTimeInterval($time_interval);

  /**
   * @param mixed $postcode
   */
  public function setPostcode($postcode);

}
