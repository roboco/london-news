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

  /**
   * Constructs a new WeatherFieldApiCall object.
   * @param \GuzzleHttp\ClientInterface $http_client
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config
   */
  public function __construct(ClientInterface $http_client, ConfigFactoryInterface $config) {
    $this->httpClient = $http_client;
  }

}
