<?php

namespace Drupal\weather_field\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WeatherFieldConfigForm.
 */
class WeatherFieldConfigForm extends ConfigFormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'weather_field_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'weather_field.weatherfieldconfig',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('weather_field.weatherfieldconfig');

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#description' => $this->t('API Key for World Weather Online'),
      '#weight' => '0',
      '#default_value' => $config->get('api_key'),
    ];
    $form['service_url'] = [
      '#type' => 'select',
      '#title' => $this->t('Service URL'),
      '#description' => $this->t('World Weather Online'),
      '#options' => ['https://api.worldweatheronline.com/premium/v1/' => $this->t('https://api.worldweatheronline.com/premium/v1/')],
      '#size' => 1,
      '#default_value' => $config->get('service_url'),
      '#weight' => '0',
    ];
    $form['service_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Service Type'),
      '#description' => $this->t('Choose the type of meterological data'),
      '#options' => ['weather' => $this->t('weather'), 'past-weather' => $this->t('past-weather'), 'marine' => $this->t('marine'), 'past-marine' => $this->t('past-marine'), 'ski' => $this->t('ski'), 'tz' => $this->t('tz'), 'search' => $this->t('search')],
      '#size' => 1,
      '#default_value' => $config->get('service_type'),
      '#weight' => '0',
    ];
    $form['data_format'] = [
      '#type' => 'select',
      '#title' => $this->t('Format'),
      '#description' => $this->t('Choose the format of the returned api'),
      '#options' => ['json' => $this->t('json'), 'xml' => $this->t('xml')],
      '#size' => 1,
      '#default_value' => $config->get('data_format'),
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
    $config = $this->config('weather_field.weatherfieldconfig');
      $config->set('api_key', $form_state->getValue('api_key'));
      $config->set('service_url', $form_state->getValue('service_url'));
      $config->set('service_type', $form_state->getValue('service_type'));
      $config->set('data_format', $form_state->getValue('data_format'));
      $config->save();
  }

}
