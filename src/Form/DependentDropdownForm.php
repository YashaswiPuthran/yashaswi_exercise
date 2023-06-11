<?php

namespace Drupal\yashaswi_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * For dependent form.
 */
class DependentDropdownForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    // Returning the form id.
    return 'dependent_dropdown_Form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Location stored in opt variable.
    $opt = $this->location();
    // Using getvalue to get the value of category and store it in cat.
    $cat = $form_state->getValue('category') ?: 'none';
    // Using getvalue to get the value of available items in avai.
    $avai = $form_state->getValue('availableitems') ?: 'none';
    $form['category'] = [
    // Type is select.
      '#type' => 'select',
    // Providing the title.
      '#title' => 'country',
    // Options stored in opt variable.
      '#options' => $opt,
    // Setting default value.
      'default_value' => $cat,
      '#ajax' => [
    // This is the event.
        'callback' => '::DropdownCallback',
    // Defining which element will get altered.
        'wrapper' => 'field-container',
    // Event is change since it is a select element.
        'event' => 'change',
      ],
    ];
    $form['availableitems'] = [
    // Type is select.
      '#type' => 'select',
    // Providing the title.
      '#title' => 'state',
    // Options stored in cat variable.
      '#options' => static::availableItems($cat),
    // If the form is empty get value from the available items.
      '#default_value' => !empty($form_state->getValue('availableitems')) ? $form_state->getValue('availableitems') : 'none',
    // Providing a prefix value.
      '#prefix' => '<div id="field-container"',
    // Providing suffix.
      '#suffix' => '</div>',
      '#ajax' => [
    // This is the event.
        'callback' => '::DropdownCallback',
    // Defining which element will get altered.
        'wrapper' => 'dist-container',
    // Event is change since it is a select element.
        'event' => 'change',
      ],
    ];
    $form['district'] = [
    // Type is select.
      '#type' => 'select',
    // Providing the title.
      '#title' => 'district',
      '#options' => static::district($avai),
    // If the form is empty get value from the district items.
      '#default_value' => !empty($form_state->getValue('district')) ? $form_state->getValue('district') : '',
    // Providing a prefix value.
      '#prefix' => '<div id="dist-container"',
    // Providing suffix.
      '#suffix' => '</div>',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Submit form this string is triggered and element stored on trigger.
    $trigger = (string) $form_state->getTriggeringElement()['#value'];
    // If it is not equal to submit.
    if ($trigger != 'submit') {
      // Rebuild the form state.
      $form_state->setRebuild();
    }
  }

  /**
   * For drop down.
   */
  public function dropdownCallback(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];

    // If element name is equal to category.
    if ($triggering_element_name === 'category') {
      // Return the values of available items.
      return $form['availableitems'];
    }
    // If element name is equal to available items.
    elseif ($triggering_element_name === 'availableitems') {
      // Return the district values.
      return $form['district'];
    }

  }

  /**
   * For location.
   */
  public function location() {
    // Setting the location values.
    return [
      'none' => '-none-',
      'Japan' => 'Japan',
    ];
  }

  /**
   * For available items.
   */
  public function availableItems($cat) {
    switch ($cat) {
      case 'Japan':
        $opt = [
          'Tokyo' => 'tokyo',
          'Chubu' => 'chubu',
        ];
        break;

      default:
        $opt = ['none' => '-none-'];
        break;
    }
    return $opt;
  }

  /**
   * For district.
   */
  public function district($avai) {
    switch ($avai) {
      case 'Tokyo':
        $opt = [
          'Fuchu' => 'Fuchu',
          'Machida' => 'Machida',
          'Hachioji' => 'Hachioji',
        ];
        break;

      case 'Chubu':
        $opt = [
          'Nagoya' => 'Nagoya',
          'Shizuoka' => 'Shizuoka',
          'Gifu' => 'Gifu',
        ];
        break;
    }
    return $opt;
  }

}
