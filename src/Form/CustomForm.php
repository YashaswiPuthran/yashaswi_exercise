<?php

namespace Drupal\yashaswi_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * For custom form.
 */
class CustomForm extends FormBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * CustomForm constructor.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form_get_user_details';
  }

  /**
   * {@inheritdoc}
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

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Submitting the form.
    // Using messenger service to display the submitted message.
    \Drupal::messenger()->addMessage("User Details Submitted Successfully");
    // To insert values into the database.
    $this->database->insert("user_details")->fields([
      'username' => $form_state->getValue("username"),
      'name' => $form_state->getValue("name"),
      'email' => $form_state->getValue("email"),
      'age' => $form_state->getValue("age"),
    ])->execute();
  }

}
