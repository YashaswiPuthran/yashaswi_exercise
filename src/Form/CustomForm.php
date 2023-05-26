<?php

namespace Drupal\yashaswi_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomForm extends FormBase { #formbase implements interface and interface has getformid, buildform, validateform and submit form

    // generated form id
    public function getFormId() # to get the form id
    {
        return 'custom_form_get_user_details'; #form id
    }

    // build form generates form
    public function buildForm(array $form, FormStateInterface $form_state) { # building form by adding the required fields
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
        return $form; # this will display the form with fields
    }


    // submit form
    public function submitForm(array &$form, FormStateInterface $form_state) { # submitting the form
        \Drupal::messenger()->addMessage("User Details Submitted Successfully"); # using messenger service to display the submitted message
        \Drupal::database()->insert("user_details")->fields([ # using the insert to insert values into the database that we have created in .install file
            'username' => $form_state->getValue("username"),
            'name' => $form_state->getValue("name"),
            'email' => $form_state->getValue("email"),
            'age' => $form_state->getValue("age"),
        ])->execute();
    }
}