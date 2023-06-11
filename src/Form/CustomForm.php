<?php

namespace Drupal\yashaswi_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * For custom form.
 */
class CustomForm extends FormBase {
  // It has submit form.

  /**
   * Generated form id.
   */
  public function getFormId() {
    // To get the form id.
    // Form id.
    return 'custom_form_get_user_details';
  }

  /**
   * Build form generates form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Building form by adding the required fields.
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => 'User Name',
      '#required' => TRUE,
      '#placeholder' => 'User Name',
    ];
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => 'Full Name',
      '#required' => FALSE,
      '#placeholder' => 'Your Name',
    ];
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => 'Email',
      '#default_value' => 'example@gmail.com',
    ];
    $form['age'] = [
      '#type' => 'select',
      '#title' => 'Age',
      '#options' => [
        '18plus' => '18+',
        '18minus' => '18-',
      ],
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];
    // This will display the form with fields.
    return $form;
  }

  /**
   * Submit form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Submitting the form.
    // Using messenger service to display the submitted message.
    \Drupal::messenger()->addMessage("User Details Submitted Successfully");
    // To insert values into the database.
    \Drupal::database()->insert("user_details")->fields([
      'username' => $form_state->getValue("username"),
      'name' => $form_state->getValue("name"),
      'email' => $form_state->getValue("email"),
      'age' => $form_state->getValue("age"),
    ])->execute();
  }

}
