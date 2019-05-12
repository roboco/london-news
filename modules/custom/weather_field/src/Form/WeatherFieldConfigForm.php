<?php

namespace Drupal\weather_field\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WeatherFieldConfigForm.
 */
class WeatherFieldConfigForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'weather_field_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['api_key'] = [
      '#type' => 'text_format',
      '#title' => $this->t('API Key'),
      '#description' => $this->t('API Key for World Weather Online'),
      '#weight' => '0',
    ];
    $form['service_url'] = [
      '#type' => 'select',
      '#title' => $this->t('Service URL'),
      '#description' => $this->t('World Weather Online'),
      '#options' => ['https://api.worldweatheronline.com/premium/v1/' => $this->t('https://api.worldweatheronline.com/premium/v1/')],
      '#size' => 5,
      '#default_value' =>'https://api.worldweatheronline.com/premium/v1/',
      '#weight' => '0',
    ];
    $form['service_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Service Type'),
      '#description' => $this->t('Choose the type of meterological data'),
      '#options' => ['weather' => $this->t('weather'), 'past-weather' => $this->t('past-weather'), 'marine' => $this->t('marine'), 'past-marine' => $this->t('past-marine'), 'ski' => $this->t('ski'), 'tz' => $this->t('tz'), 'search' => $this->t('search')],
      '#size' => 5,
      '#default_value' => 'weather',
      '#weight' => '0',
    ];
    $form['data_format'] = [
      '#type' => 'select',
      '#title' => $this->t('Format'),
      '#description' => $this->t('Choose the format of the returned api'),
      '#options' => ['json' => $this->t('json'), 'xml' => $this->t('xml'), 'marine' => $this->t('marine'), 'past-marine' => $this->t('past-marine'), 'ski' => $this->t('ski'), 'tz' => $this->t('tz'), 'search' => $this->t('search')],
      '#size' => 5,
      '#default_value' => 'json',
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}
