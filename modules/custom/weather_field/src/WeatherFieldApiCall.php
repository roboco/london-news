<?php

namespace Drupal\weather_field;
use Drupal\Core\Config\ConfigFactoryInterface;
use GuzzleHttp\ClientInterface;

/**
 * Class WeatherFieldApiCall.
 */
class WeatherFieldApiCall implements WeatherFieldApiCallInterface {

  /**
   * GuzzleHttp\ClientInterface definition.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  protected $config;

  private $postcode;

  private $time_interval;

  private $num_days;

  private $weather;

  /**
   * @return mixed
   */
  public function getWeather() {
    $this->weather = $this->buildRequest();
    return $this->weather;
  }

  /**
   * @param mixed $num_days
   */
  public function setNumDays($num_days) {
    $this->num_days = $num_days;
  }

  /**
   * @param mixed $time_interval
   */
  public function setTimeInterval($time_interval) {
    $this->time_interval = $time_interval;
  }

  /**
   * @param mixed $postcode
   */
  public function setPostcode($postcode) {
    $this->postcode = $postcode;
  }

  /**
   * Constructs a new WeatherFieldApiCall object.
   * @param \GuzzleHttp\ClientInterface $http_client
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config
   */
  public function __construct(ClientInterface $http_client, ConfigFactoryInterface $config) {
    $this->httpClient = $http_client;
    $this->config = $config;
  }

  private function buildRequest() {
    $weather = "breexy";
    return $weather;
  }


}
