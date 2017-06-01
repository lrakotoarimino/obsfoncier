<?php

namespace Drupal\permisautorisation\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PermisautorisationTypeForm.
 *
 * @package Drupal\permisautorisation\Form
 */
class PermisautorisationTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $permisautorisation_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $permisautorisation_type->label(),
      '#description' => $this->t("Label for the Permisautorisation type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $permisautorisation_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\permisautorisation\Entity\PermisautorisationType::load',
      ],
      '#disabled' => !$permisautorisation_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $permisautorisation_type = $this->entity;
    $status = $permisautorisation_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Permisautorisation type.', [
          '%label' => $permisautorisation_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Permisautorisation type.', [
          '%label' => $permisautorisation_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($permisautorisation_type->toUrl('collection'));
  }

}
