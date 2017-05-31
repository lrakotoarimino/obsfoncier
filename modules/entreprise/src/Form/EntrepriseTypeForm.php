<?php

namespace Drupal\entreprise\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class EntrepriseTypeForm.
 *
 * @package Drupal\entreprise\Form
 */
class EntrepriseTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $entreprise_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $entreprise_type->label(),
      '#description' => $this->t("Label for the Entreprise type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $entreprise_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\entreprise\Entity\EntrepriseType::load',
      ],
      '#disabled' => !$entreprise_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entreprise_type = $this->entity;
    $status = $entreprise_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Entreprise type.', [
          '%label' => $entreprise_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Entreprise type.', [
          '%label' => $entreprise_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($entreprise_type->toUrl('collection'));
  }

}
