<?php

namespace Drupal\entreprise\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Entreprise edit forms.
 *
 * @ingroup entreprise
 */
class EntrepriseForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\entreprise\Entity\Entreprise */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;
    
    /*$form['cd_entreprise'] = array(
    		'#title' => $this->t("Code de l'entreprise"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getCdEntreprise(),
    );*/
    
    
    $form['entreprise_id'] = array(
    		'#type' => 'hidden',
    );
    
    $form['adresse'] = array(
    		'#title' => $this->t("Contact et adresse de l'entreprise"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getAdresse(),
    );
    
    $form['cd_projet'] = array(
    		'#title' => $this->t("Code du projet"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getCdProjet(),
    );
    
    
    $options = array();
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
    		'#default_value' => $entity->getSecteurId(),
    );
    
    
    $options = array();
    $nidPhases= \Drupal::entityQuery('phase')
    ->execute();
    $phases = \Drupal::entityTypeManager()->getStorage('phase')->loadMultiple($nidPhases);
    foreach ($phases as $nid => $phase) {
    	$options[$nid] = $phase->get('name')->getValue()['0']['value'];
    }
    asort($options);
    $form['phase_id'] = array(
    		'#title' => $this->t("Phase"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez une phase--'),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entity->getPhaseId(),
    );
    
    $options = array();
    $nidFormeJuridiques= \Drupal::entityQuery('formejuridique')
    ->execute();
    $formesJuridiques = \Drupal::entityTypeManager()->getStorage('formejuridique')->loadMultiple($nidFormeJuridiques);
    foreach ($formesJuridiques as $nid => $formeJuridique) {
    	$options[$nid] = $formeJuridique->get('name')->getValue()['0']['value'];
    }
    asort($options);
    $form['formejuridique_id'] = array(
    		'#title' => $this->t("Forme juridique"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez une forme juridique--'),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entity->getFormeJuridiqueId(),
    );
    
    $options = array();
    $nidActivites= \Drupal::entityQuery('activite')
    ->execute();
    $activites = \Drupal::entityTypeManager()->getStorage('activite')->loadMultiple($nidActivites);
    foreach ($activites as $nid => $activite) {
    	$options[$nid] = $activite->get('name')->getValue()['0']['value'];
    }
    asort($options);
    $form['activite_id'] = array(
    		'#title' => $this->t("Activité"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez une activité--'),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entity->getActiviteId(),
    );
    
    $options = array();
    $nidPays= \Drupal::entityQuery('pays')
    ->execute();
    $payss = \Drupal::entityTypeManager()->getStorage('pays')->loadMultiple($nidPays);
    foreach ($payss as $nid => $pays) {
    	$options[$nid] = $pays->get('name')->getValue()['0']['value'];
    }
    asort($options);
    $form['pays_id'] = array(
    		'#title' => $this->t("Pays"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez un pays--'),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entity->getPaysId(),
    );
    
    
    $form['duree_projet'] = array(
    		'#title' => $this->t("M4 Durée du projet (en années)"),
    		'#type' => 'integer',
    		'#default_value' => $entity->getDureeProjet(),
    );
    
    
    //On cache l'auteur
    $form['user_id']['#access'] = FALSE;
    
    $form['actions']['back']= array(
    		'#type' => 'button',
    		'#value' => $this->t("Retour"),
    		'#weight' => 10, 
    		'#attributes' => array('onclick' => 'window.history.back();return false;',),
    );
   

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;
    
    $status = parent::save($form, $form_state);
    $id = $entity->id(); //Id du projet/entreprise
    $form_state->setValue('id', $id); //On force, surtout pour la creation
    
    
    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Entreprise.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Entreprise.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.entreprise.canonical', ['entreprise' => $entity->id()]);
  }

}
