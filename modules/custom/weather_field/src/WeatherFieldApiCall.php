<?php

namespace Drupal\weather_field;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

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

  private $location;

  private $time_interval;

  private $num_days;

  private $weather;

  /**
   * @return mixed
   */
  public function getWeather() {
    $this->weather = $this->response();
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
  public function setLocation($location) {
    $this->location = $location;
  }

  /**
   * Constructs a new WeatherFieldApiCall object.
   * @param \GuzzleHttp\ClientInterface $http_client
   */
  public function __construct(ClientInterface $http_client) {
    $this->httpClient = $http_client;
  }

  private function response() {
    $url = $this->buildRequest();
    $status = '';
    try {
      $request = $this->httpClient->request('GET', $url);
      $status = $request->getStatusCode();
      $transfer_success = $request->getBody()->getContents();
      return $transfer_success;
    }
    catch (RequestException $e) {
      $message = 'Weather Field E-petition api request failed with' . $e . '::' . $status;
      \Drupal::logger('weather_field')->error($message);
    }
    return false;
  }

  /**
   * @param $red_type
   * @param $url_params
   *
   * @return string
   */
  private function buildRequest() {
    $config = \Drupal::config('weather_field.weatherfieldconfig');
    $url = $config->get('service_url');
    $api_key = $config->get('api_key');
    $data_format = $config->get('data_format');

    $url_params = [
      'key' => $api_key,
      'q' => $this->location,
      'format' => $data_format,
      'num_of_days' => $this->num_days];

    $url = $url . '/weather.ashx';
    $url .= '?';
    foreach ($url_params as $key => $value) {
      $url .= $key . '=' . $value . '&';
    }
    return $url;
  }


}
