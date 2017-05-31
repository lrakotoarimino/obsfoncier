<?php

namespace Drupal\permisminier\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PermisminierTypeForm.
 *
 * @package Drupal\permisminier\Form
 */
class PermisminierTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $permisminier_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $permisminier_type->label(),
      '#description' => $this->t("Label for the Permisminier type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $permisminier_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\permisminier\Entity\PermisminierType::load',
      ],
      '#disabled' => !$permisminier_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $permisminier_type = $this->entity;
    $status = $permisminier_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Permisminier type.', [
          '%label' => $permisminier_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Permisminier type.', [
          '%label' => $permisminier_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($permisminier_type->toUrl('collection'));
  }

}
