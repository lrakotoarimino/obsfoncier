<?php

namespace Drupal\contrat\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Contrat edit forms.
 *
 * @ingroup contrat
 */
class ContratForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\contrat\Entity\Contrat */
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
    
    $options = getOptions('motifavenant');
    $form['phase_id'] = array(
    		'#title' => $this->t("Motif avenant"),
    		'#type' => 'select',
    		'#empty_option' => $this->t("--Selectionnez un motif de l'avenant--"),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entity->getMotifavenantId(),
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
        drupal_set_message($this->t('Created the %label Contrat.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Contrat.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.contrat.canonical', ['contrat' => $entity->id()]);
  }

}
