<?php

namespace Drupal\typepermis\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TypepermisTypeForm.
 *
 * @package Drupal\typepermis\Form
 */
class TypepermisTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $typepermis_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $typepermis_type->label(),
      '#description' => $this->t("Label for the Typepermis type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $typepermis_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\typepermis\Entity\TypepermisType::load',
      ],
      '#disabled' => !$typepermis_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $typepermis_type = $this->entity;
    $status = $typepermis_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Typepermis type.', [
          '%label' => $typepermis_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Typepermis type.', [
          '%label' => $typepermis_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($typepermis_type->toUrl('collection'));
  }

}
