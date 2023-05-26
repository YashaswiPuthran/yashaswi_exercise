<?php

namespace Drupal\custom_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Define the "custom field formatter".
 *
 * @FieldFormatter(
 *   id = "custom_field_formatter",
 *   label = @Translation("Custom Field Formatter"),
 *   description = @Translation("Desc for Custom Field Formatter"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */


class CustomFieldFormatter extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() { #this is the default function
        return [
            'concat' => 'Concat with ', #a message concat with will be displayed on manage display page infront of the field
        ] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */

    public function settingsForm(array $form, FormStateInterface $form_state) {
        $form['concat'] =[
            '#type' => 'textfield', #this is the type of concat field
            '#title' => 'Concatenate with', #title for the field
            '#default_value' => $this->getSetting('concat'), # default value for the field is obtained using getsetting it gets the value of concat from default settings
        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t("concatenate with : @concat", ["@concat" => $this->getSetting('concat')]); # @concat gets the value of the concat
        return $summary;
    }

    /**
     * {@inheritdoc}
     */

     public function viewElements(FieldItemListInterface $items, $langcode) {
        $element = [];

        foreach ( $items as $delta => $item) {
            $element[$delta] = [
                '#markup' => $this->getSetting('concat') . $item->value, #gets value of concat
            ];
        }
        return $element;
     }

}