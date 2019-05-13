<?php

namespace Drupal\weather_field\Plugin\Field\FieldFormatter;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\weather_field\WeatherFieldApiCallInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Plugin implementation of the 'weather_field_formatter_type' formatter.
 *
 * @FieldFormatter(
 *   id = "weather_field_formatter_type",
 *   label = @Translation("Weather Field Formatter"),
 *   field_types = {
 *     "weather_field_type"
 *   }
 * )
 */
class WeatherFieldFormatterType extends FormatterBase implements ContainerFactoryPluginInterface {


  /**
   * The entity manager service
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $weatherFieldApiCall;

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('weather_field.api_call')
    );
  }


  /**
   * Construct a MyFormatter object
   *
   * @param $plugin_id
   * @param $plugin_definition
   * @param \Drupal\weather_field\Plugin\Field\FieldFormatter\FieldDefinitionInterface $field_definition
   * @param array $settings
   * @param $label
   * @param $view_mode
   * @param array $third_party_settings
   * @param \Drupal\weather_field\WeatherFieldApiCallInterface $weatherFieldApiCall
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, WeatherFieldApiCallInterface $weatherFieldApiCall) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->weatherFieldApiCall = $weatherFieldApiCall;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();

    foreach ($items as $delta => $item) {
      $this->weatherFieldApiCall->setLocation($item->location);
      $this->weatherFieldApiCall->setNumDays($item->num_days);
      $this->weatherFieldApiCall->setTimeInterval($item->time_interval);

        $weather = Json::decode($this->weatherFieldApiCall->getWeather());
        $current_weather = $weather['data']['current_condition'][0]['weatherDesc'][0]['value'];
        $weather_icon = $weather['data']['current_condition'][0]['weatherIconUrl'][0]['value'];
        $temp = $weather['data']['current_condition'][0]['temp_C'];
        $elements[$delta] = array(
            '#theme' => 'weather_field_widget',
            '#location' => $item->location,
            '#currentWeather' => $current_weather,
            '#weatherIcon' => $weather_icon,
            '#temperature' => $temp,
            '#weather' => $weather,
        );
    }

    return $elements;
  }

}
