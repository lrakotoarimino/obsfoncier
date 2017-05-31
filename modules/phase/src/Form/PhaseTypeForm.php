<?php

namespace Drupal\phase\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PhaseTypeForm.
 *
 * @package Drupal\phase\Form
 */
class PhaseTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $phase_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $phase_type->label(),
      '#description' => $this->t("Label for the Phase type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $phase_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\phase\Entity\PhaseType::load',
      ],
      '#disabled' => !$phase_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $phase_type = $this->entity;
    $status = $phase_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Phase type.', [
          '%label' => $phase_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Phase type.', [
          '%label' => $phase_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($phase_type->toUrl('collection'));
  }

}
