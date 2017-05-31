<?php

namespace Drupal\formejuridique\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class FormejuridiqueTypeForm.
 *
 * @package Drupal\formejuridique\Form
 */
class FormejuridiqueTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $formejuridique_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $formejuridique_type->label(),
      '#description' => $this->t("Label for the Formejuridique type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $formejuridique_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\formejuridique\Entity\FormejuridiqueType::load',
      ],
      '#disabled' => !$formejuridique_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $formejuridique_type = $this->entity;
    $status = $formejuridique_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Formejuridique type.', [
          '%label' => $formejuridique_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Formejuridique type.', [
          '%label' => $formejuridique_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($formejuridique_type->toUrl('collection'));
  }

}
