<?php

namespace Drupal\contrat\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ContratTypeForm.
 *
 * @package Drupal\contrat\Form
 */
class ContratTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $contrat_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $contrat_type->label(),
      '#description' => $this->t("Label for the Contrat type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $contrat_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\contrat\Entity\ContratType::load',
      ],
      '#disabled' => !$contrat_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $contrat_type = $this->entity;
    $status = $contrat_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Contrat type.', [
          '%label' => $contrat_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Contrat type.', [
          '%label' => $contrat_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($contrat_type->toUrl('collection'));
  }

}
