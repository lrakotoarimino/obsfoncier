<?php

namespace Drupal\contractualisation\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class contractualisationTypeForm.
 *
 * @package Drupal\contractualisation\Form
 */
class contractualisationTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $contractualisation_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $contractualisation_type->label(),
      '#description' => $this->t("Label for the Contractualisation type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $contractualisation_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\contractualisation\Entity\contractualisationType::load',
      ],
      '#disabled' => !$contractualisation_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $contractualisation_type = $this->entity;
    $status = $contractualisation_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Contractualisation type.', [
          '%label' => $contractualisation_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Contractualisation type.', [
          '%label' => $contractualisation_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($contractualisation_type->toUrl('collection'));
  }

}
