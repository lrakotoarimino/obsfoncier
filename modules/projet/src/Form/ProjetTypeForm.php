<?php

namespace Drupal\projet\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ProjetTypeForm.
 *
 * @package Drupal\projet\Form
 */
class ProjetTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $projet_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $projet_type->label(),
      '#description' => $this->t("Label for the Projet type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $projet_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\projet\Entity\ProjetType::load',
      ],
      '#disabled' => !$projet_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $projet_type = $this->entity;
    $status = $projet_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Projet type.', [
          '%label' => $projet_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Projet type.', [
          '%label' => $projet_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($projet_type->toUrl('collection'));
  }

}
