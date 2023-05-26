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

    public static function schema(FieldStorageDefinitionInterface $field_definition) { # this creates a schema with the fields defined below
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
    public static function defaultStorageSettings() { #default settings for the length
        return [
            'length' => 255, # default value for length is 255
        ] + parent::defaultStorageSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
        $element = [];

        $element['length'] = [ # building the form element
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
    public static function defaultFieldSettings() { # default value for the more info field
        return [
            'moreinfo' => "More info default value", # setting the default message for the field's field
        ] + parent::defaultFieldSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
        $element = [];
        $element['moreinfo'] = [ # building the more info field
            '#type' => 'textfield', # providing the type
            '#title' => 'More information about this field', # title
            '#required' => TRUE,#this is a required field
            '#default_value' => $this->getSetting("moreinfo"), #default value obtained from the prev function
        ];
        return $element;
    }

    /**
     * {@inheritdoc}
     */
    public static function PropertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties['value'] = DataDefinition::create('string')->setLabel(t("Name"));

        return $properties;
    }
}