<?php

namespace Drupal\motifavenant\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MotifavenantTypeForm.
 *
 * @package Drupal\motifavenant\Form
 */
class MotifavenantTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $motifavenant_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $motifavenant_type->label(),
      '#description' => $this->t("Label for the Motifavenant type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $motifavenant_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\motifavenant\Entity\MotifavenantType::load',
      ],
      '#disabled' => !$motifavenant_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $motifavenant_type = $this->entity;
    $status = $motifavenant_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Motifavenant type.', [
          '%label' => $motifavenant_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Motifavenant type.', [
          '%label' => $motifavenant_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($motifavenant_type->toUrl('collection'));
  }

}
