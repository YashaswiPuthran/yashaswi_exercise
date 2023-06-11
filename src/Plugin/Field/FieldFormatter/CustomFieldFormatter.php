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
  public static function defaultSettings() {
    // This is the default function.
    return [
    // A message concat with will be displayed on manage display page.
      'concat' => 'Concat with ',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['concat'] = [
    // This is the type of concat field.
      '#type' => 'textfield',
    // Title for the field.
      '#title' => 'Concatenate with',
    // Default value for the field is obtained using getsetting.
      '#default_value' => $this->getSetting('concat'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // @concat gets the value of the concat
    $summary[] = $this->t("concatenate with : @concat", ["@concat" => $this->getSetting('concat')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      $element[$delta] = [
      // Gets value of concat.
        '#markup' => $this->getSetting('concat') . $item->value,
      ];
    }
    return $element;
  }

}
