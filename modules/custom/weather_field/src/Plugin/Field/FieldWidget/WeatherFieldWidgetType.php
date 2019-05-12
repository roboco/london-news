<?php

namespace Drupal\weather_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'weather_field_widget_type' widget.
 *
 * @FieldWidget(
 *   id = "weather_field_widget_type",
 *   label = @Translation("Weather Field Widget"),
 *   field_types = {
 *     "weather_field_type"
 *   }
 * )
 */
class WeatherFieldWidgetType extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'size' => 60,
      'placeholder' => '',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    $elements['size'] = [
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    ];
    $elements['placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t('Textfield size: @size', ['@size' => $this->getSetting('size')]);
    if (!empty($this->getSetting('placeholder'))) {
      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $this->getSetting('placeholder')]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    // TODO: Could live in side panel.
//    $element = [
//      '#type' => 'details',
//      '#title' => t('Weather Field Query'),
//      '#group' => 'advanced',
//      '#weight' => 100,
//    ];


    $element['location'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Location'),
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#description' => $this->t('UK Postcode, Pass US Zipcode, Canada Postalcode, IP address, Latitude/Longitude (decimal degree) or city name'),
      '#size' => $this->getSetting('size'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#maxlength' => $this->getFieldSetting('max_length'),
      '#attributes' => array('id' => 'wf-location'),
    ];

    $element['num_days'] = [
        '#title' => $this->t('Number of Days'),
        '#type' => 'select',
        '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
        '#options' => [
          '1' => $this->t('One'),
          '2' => $this->t('Two'),
          '3' => $this->t('Three'),
          '4' => $this->t('Four'),
          '5' => $this->t('Five')
          ],
      ];

    $element['time_interval'] = [
        '#title' => $this->t('time interval'),
        '#type' => 'select',
        '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
        '#options' => [
          '24' => $this->t('24 Hour'),
          '12' => $this->t('12 Hour'),
          '6' => $this->t('6 Hour'),
          '3' => $this->t('3 Hour'),
          '1' => $this->t('1 Hour')
        ],
      ];

    $element['refresh_rate'] = [
        '#title' => $this->t('Refresh Rate'),
        '#type' => 'select',
        '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
        '#options' => [
          '60' => $this->t('1 min'),
          '3600' => $this->t('5 min'),
          'page' => $this->t('On Page Refresh'),
          'none' => $this->t('On New Cache Load')
        ],
      ];

    return $element;
  }

}
