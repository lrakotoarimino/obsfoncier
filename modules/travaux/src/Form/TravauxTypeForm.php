<?php

namespace Drupal\travaux\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TravauxTypeForm.
 *
 * @package Drupal\travaux\Form
 */
class TravauxTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $travaux_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $travaux_type->label(),
      '#description' => $this->t("Label for the Liste des travaux type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $travaux_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\travaux\Entity\TravauxType::load',
      ],
      '#disabled' => !$travaux_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $travaux_type = $this->entity;
    $status = $travaux_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Liste des travaux type.', [
          '%label' => $travaux_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Liste des travaux type.', [
          '%label' => $travaux_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($travaux_type->toUrl('collection'));
  }

}
