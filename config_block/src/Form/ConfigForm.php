<?php

namespace Drupal\config_block\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * This extends the base class.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * Settings Variable.
   */
  const CONFIGNAME = "yashaswi_exercise.settings";

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    // We are returning the form id using this function.
    return "custom_config_form_settings";
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    // A static variable.
    return [
      static::CONFIGNAME,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Building a form by adding the fields.
    $config = $this->config(static::CONFIGNAME);
    $form['username'] = [
      '#type' => 'textfield',
    // Using span here and attached library to get color from style.css.
      '#title' => '<span>Username</span>',
      '#attached' => [
        'library' => [
          'yashaswi_exercise/new_lib',
        ],
      ],
      // Setting default value as the value provided in the form.
      '#default_value' => $config->get("username"),
    ];

    // Adding another field.
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => '<span>email</span>',
      '#attached' => [
    // Using span here and attached library to get color from style.css.
        'library' => [
          'yashaswi_exercise/new_lib',
        ],
      ],
      '#default_value' => $config->get("email"),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // This function gets called when we are submitting the form.
    $config = $this->config(static::CONFIGNAME);
    // Setting the values according to how we submitted the values.
    $config->set("username", $form_state->getValue('username'));
    $config->set("email", $form_state->getValue('email'));
    $config->save();
  }

}
