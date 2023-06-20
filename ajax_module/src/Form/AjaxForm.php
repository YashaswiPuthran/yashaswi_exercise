<?php

namespace Drupal\ajax_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the MyForm form controller.
 */
class AjaxForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['text_field'] = [
      '#type' => 'textfield',
      '#title' => 'Text Field',
    ];

    $form['checkbox_field'] = [
      '#type' => 'checkbox',
      '#title' =>'Checkbox Field',
    ];

    $form['third_field'] = [
      '#type' => 'textfield',
      '#title' => 'Third Field',
      '#states' => [
        'invisible' => [
          ':input[name="checkbox_field"]' => ['checked' => TRUE],
        ],
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}