<?php

namespace Drupal\custom_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Define the "custom field type".
 *
 * @FieldWidget(
 *   id = "custom_field_widget",
 *   label = @Translation("Custom Field Widget"),
 *   description = @Translation("Desc for Custom Field Widget"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */
class CustomFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = $items[$delta]->value ?? "";
    // Building the elements.
    $element = $element + [
      '#type' => 'textfield',
      '#suffix' => "<span>" . $this->getFieldSetting("moreinfo") . "</span>",
      '#default_value' => $value,
      '#attributes' => [
        'placeholder' => $this->getSetting('placeholder'),
      ],
    ];
    return ['value' => $element];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    // Default value of placeholder.
    return [
      'placeholder' => 'default',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['placeholder'] = [
    // Building placeholder element this is tht type.
      '#type' => 'textfield',
    // Title.
      '#title' => 'Placeholder text',
    // Default value obtained from previous function.
      '#default_value' => $this->getSetting('placeholder'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Value from placeholder is concated in summary.
    $summary[] = $this->t("placeholder text: @placeholder", ["@placeholder" => $this->getSetting("placeholder")]);
    return $summary;
  }

}
