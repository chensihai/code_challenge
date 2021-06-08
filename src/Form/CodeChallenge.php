<?php

namespace Drupal\code_challenge\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CodeChallenge.
 */
class CodeChallenge extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'code_challenge.codechallenge',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'code_challenge';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('code_challenge.codechallenge');
    $form['api_endpoint'] = [
      '#type' => 'url',
      '#title' => $this->t('Api Endpoint'),
      '#default_value' => $config->get('api_endpoint'),
    ];
    $form['meta_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Meta Message'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('meta_message'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('code_challenge.codechallenge')
      ->set('api_endpoint', $form_state->getValue('api_endpoint'))
      ->set('meta_message', $form_state->getValue('meta_message'))
      ->save();
  }

}
