<?php

namespace Drupal\pays\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PaysTypeForm.
 *
 * @package Drupal\pays\Form
 */
class PaysTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $pays_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $pays_type->label(),
      '#description' => $this->t("Label for the Pays type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $pays_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\pays\Entity\PaysType::load',
      ],
      '#disabled' => !$pays_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $pays_type = $this->entity;
    $status = $pays_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Pays type.', [
          '%label' => $pays_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Pays type.', [
          '%label' => $pays_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($pays_type->toUrl('collection'));
  }

}
