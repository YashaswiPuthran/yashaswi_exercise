<?php

namespace Drupal\yashaswi_exercise\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase {

    /**
     * Settings Variable.
     */
    Const CONFIGNAME = "yashaswi_exercise.settings";

    /**
     * {@inheritdoc}
     */
    public function getFormId() { # we are returning the form id using this function
        return "custom_config_form_settings";
    }

    /**
     * {@inheritdoc}
     */

    protected function getEditableConfigNames() { #a static variable
        return [
            static::CONFIGNAME,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) { #building a form by adding the fields
        $config = $this->config(static::CONFIGNAME);
        $form['username'] = [
            '#type' => 'textfield',
            '#title' => '<span>Username</span>', #using span here and attached library to get color from style.css
            '#attached' => [
                'library' => [
                    'yashaswi_exercise/new_lib',
                ],
            ],
            '#default_value' => $config->get("username"), #setting default value as the value provided in the form
        ];

        $form['email'] = [ #adding another field
            '#type' => 'textfield',
            '#title' => '<span>email</span>',
            '#attached' => [
                'library' => [ #using span here and attached library to get color from style.css
                    'yashaswi_exercise/new_lib',
                ],
            ],
            '#default_value' => $config->get("email"),
        ];

        return Parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) { #this function gets called when we are submitting the form
        $config = $this->config(static::CONFIGNAME);
        $config->set("username", $form_state->getValue('username')); #setting the values according to how we submitted the values
        $config->set("email", $form_state->getValue('email'));
        $config->save();
    }

}