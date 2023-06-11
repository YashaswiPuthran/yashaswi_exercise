<?php

namespace Drupal\custom_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Define the "custom field type".
 *
 * @FieldType(
 *   id = "custom_field_type",
 *   label = @Translation("Custom Field Type"),
 *   description = @Translation("Desc for Custom Field Type"),
 *   category = @Translation("Text"),
 *   default_widget = "custom_field_widget",
 *   default_formatter = "custom_field_formatter",
 * )
 */
class CustomFieldType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    // This creates a schema with the fields defined below.
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => $field_definition->getSetting("length"),
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    // Default settings for the length.
    return [
    // Default value for length is 255.
      'length' => 255,
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $element = [];

    // Building the form element.
    $element['length'] = [
      '#type' => 'number',
      '#title' => t("Length of your text"),
      '#required' => TRUE,
      '#default_value' => $this->getSetting("length"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    // Default value for the more info field.
    return [
    // Setting the default message for the field's field.
      'moreinfo' => "More info default value",
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = [];
    // Building the more info field.
    $element['moreinfo'] = [
    // Providing the type.
      '#type' => 'textfield',
    // Title.
      '#title' => 'More information about this field',
    // This is a required field.
      '#required' => TRUE,
    // Default value obtained from the prev function.
      '#default_value' => $this->getSetting("moreinfo"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')->setLabel(t("Name"));

    return $properties;
  }

}
