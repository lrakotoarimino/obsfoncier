<?php

namespace Drupal\projet\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Projet edit forms.
 *
 * @ingroup projet
 */
class ProjetForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\projet\Entity\Projet */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;
    
    
    $nidEntreprises = \Drupal::entityQuery('entreprise')
    	->execute();
    $entreprises = \Drupal::entityTypeManager()->getStorage('entreprise')->loadMultiple($nidEntreprises);
    foreach ($entreprises as $nid => $entreprise) {
    	$options[$nid] = $entreprise->get('name')->getValue()['0']['value'];
    }
    asort($options);
    
    
    $form['entreprise_id'] = array(
    		'#title' => $this->t("Entreprise"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez une entreprise--'),
    		'#options' => $options,
    		'#required' => true,
    		//'#default_value' => $entity->getEntrepriseId(),
    );
    
    $form['cd_projet'] = array(
    		'#title' => $this->t("Code du projet"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getCdProjet(),
    );
    
    
    
    $nidSecteurs= \Drupal::entityQuery('secteur')
    ->execute();
    $secteurs = \Drupal::entityTypeManager()->getStorage('secteur')->loadMultiple($nidSecteurs);
    foreach ($secteurs as $nid => $secteur) {
    	$options[$nid] = $secteur->get('name')->getValue()['0']['value'];
    }
    asort($options);
    
    $form['secteur_id'] = array(
    		'#title' => $this->t("Secteur"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez un secteur--'),
    		'#options' => $options,
    		'#required' => true,
    		//'#default_value' => $entity->getEntrepriseId(),
    );
    
    
    $nidPhases= \Drupal::entityQuery('phase')
    ->execute();
    $phases = \Drupal::entityTypeManager()->getStorage('phase')->loadMultiple($nidPhases);
    foreach ($phases as $nid => $phase) {
    	$options[$nid] = $phase->get('name')->getValue()['0']['value'];
    }
    asort($options);
    $form['phase_id'] = array(
    		'#title' => $this->t("Phasee"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez une phase--'),
    		'#options' => $options,
    		'#required' => true,
    		//'#default_value' => $entity->getEntrepriseId(),
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
        drupal_set_message($this->t('Created the %label Projet.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Projet.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.projet.canonical', ['projet' => $entity->id()]);
  }

}
