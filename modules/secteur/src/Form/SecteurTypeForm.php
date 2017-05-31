<?php

namespace Drupal\secteur\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SecteurTypeForm.
 *
 * @package Drupal\secteur\Form
 */
class SecteurTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $secteur_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $secteur_type->label(),
      '#description' => $this->t("Label for the Secteur type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $secteur_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\secteur\Entity\SecteurType::load',
      ],
      '#disabled' => !$secteur_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $secteur_type = $this->entity;
    $status = $secteur_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Secteur type.', [
          '%label' => $secteur_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Secteur type.', [
          '%label' => $secteur_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($secteur_type->toUrl('collection'));
  }

}
