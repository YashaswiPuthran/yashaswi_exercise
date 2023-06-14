<?php

namespace Drupal\dependent\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * This is to get values.
 */
class DependentDropdownForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dependent_dropdown_Form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $opt = $this->location();
    $cat = $form_state->getValue('category') ?: 'none';
    $avai = $form_state->getValue('availableitems') ?: 'none';
    $form['category'] = [
      '#type' => 'select',
      '#title' => 'country',
      '#options' => $opt,
      'default_value' => $cat,
      '#ajax' => [
        'callback' => '::DropdownCallback',
        'wrapper' => 'field-container',
        'event' => 'change',
      ],
    ];
    $form['availableitems'] = [
      '#type' => 'select',
      '#title' => 'state',
      '#options' => static::availableItems($cat),
      '#default_value' => !empty($form_state->getValue('availableitems')) ? $form_state->getValue('availableitems') : 'none',
      '#prefix' => '<div id="field-container"',
      '#suffix' => '</div>',
      '#ajax' => [
        'callback' => '::DropdownCallback',
        'wrapper' => 'dist-container',
        'event' => 'change',
      ],
    ];
    $form['district'] = [
      '#type' => 'select',
      '#title' => 'district',
      '#options' => static::district($avai),
      '#default_value' => !empty($form_state->getValue('district')) ? $form_state->getValue('district') : '',
      '#prefix' => '<div id="dist-container"',
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
    $trigger = (string) $form_state->getTriggeringElement()['#value'];
    if ($trigger != 'submit') {
      $form_state->setRebuild();
    }
  }

  /**
   * This is to get values.
   */
  public function dropdownCallback(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];

    if ($triggering_element_name === 'category') {
      return $form['availableitems'];
    }
    elseif ($triggering_element_name === 'availableitems') {
      return $form['district'];
    }

  }

  /**
   * This is to get values.
   */
  public function location() {
    return [
      'none' => '-none-',
      'Japan' => 'Japan',
    ];
  }

  /**
   * This is to get values.
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
   * This is to get values.
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
