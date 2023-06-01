<?php

namespace Drupal\yashaswi_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;


class DependentDropdownForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dependent_dropdown_Form'; //returning the form id
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $opt = $this->location(); //location stored in opt variable
    $cat = $form_state->getValue('category') ?: 'none'; //using getvalue to get the value of category and store it in cat
    $avai = $form_state->getValue('availableitems') ?: 'none'; //using getvalue to get the value of available items in avai
    $form['category'] = [
        '#type' => 'select', //type is select
        '#title' => 'country', //providing the title
        '#options' => $opt, //options stored in opt variable
        'default_value' => $cat, //setting default value
        '#ajax' => [
            'callback' => '::DropdownCallback',  // this is the event
            'wrapper' => 'field-container', //defining which element will get altered
            'event' => 'change' // event is change since it is a select element
        ]
    ];
    $form['availableitems'] = [
        '#type' => 'select', //type is select
        '#title' => 'state', //providing the title
        '#options' =>static::availableItems($cat), //options stored in cat variable
        '#default_value' => !empty($form_state->getValue('availableitems')) ? $form_state->getValue('availableitems') : 'none', //if the form is empty get value from the available items
        '#prefix' => '<div id="field-container"', //providing a prefix value
        '#suffix' => '</div>', //providing suffix
        '#ajax' => [
          'callback' => '::DropdownCallback', // this is the event
          'wrapper' => 'dist-container', //defining which element will get altered
          'event' => 'change' // event is change since it is a select element
      ]
    ];
    $form['district'] = [
          '#type' => 'select', //type is select
          '#title' => 'district', //providing the title
          '#options' =>static::district($avai),
          '#default_value' => !empty($form_state->getValue('district')) ? $form_state->getValue('district') : '',  //if the form is empty get value from the district items
          '#prefix' => '<div id="dist-container"', //providing a prefix value
          '#suffix' => '</div>', //providing suffix
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
    $trigger = (string) $form_state->getTriggeringElement()['#value']; //submit form this string is triggered and element stored on trigger
    if ($trigger != 'submit') { //if it is not equal to submit
        $form_state->setRebuild(); //rebuild the form state
    }
  }

  public function DropdownCallback(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];

    if ($triggering_element_name === 'category') { //if element name is equal to category
      return $form['availableitems']; // return the values of available items
    }
    elseif ($triggering_element_name === 'availableitems') { //if element name is equal to available items
      return $form['district']; //return the district values
    }


  }

  public function location() { //setting the location values
    return [
        'none' => '-none-',
        'Japan' => 'Japan',
    ];
  }

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

  public function district($avai) {
    switch($avai) {
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