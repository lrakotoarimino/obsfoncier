<?php

namespace Drupal\permisautorisation\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Permisautorisation edit forms.
 *
 * @ingroup permisautorisation
 */
class PermisautorisationForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\permisautorisation\Entity\Permisautorisation */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    $options = getOptions('entreprise');
    
    $form['entreprise_id'] = array(
    		'#title' => $this->t("Entreprise"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez une entreprise--'),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entity->getEntrepriseId(),
    );
    
    
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Permisautorisation.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Permisautorisation.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.permisautorisation.canonical', ['permisautorisation' => $entity->id()]);
  }

}
