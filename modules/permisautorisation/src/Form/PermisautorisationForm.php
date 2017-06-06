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
    
    $form['name']['#access'] = FALSE;

    $entity = $this->entity;

    $options = getOptions('entreprise');
    
    $path = \Drupal::request()->getpathInfo();
    $arg  = explode('/',$path);
    $entrepriseId = 0;
    if ($arg[4]=='add' && isset($arg[6])) {
    	$entrepriseId = ($arg[6]);
    	
    }
    if ($arg[5]=='edit') {
    	$entrepriseId = $entity->getEntrepriseId();
    }
    $entrepriseId = intVal($entrepriseId);
    
    $form['entreprise_id'] = array(
    		'#title' => $this->t("Entreprise"),
    		'#type' => 'hidden',
    		'#empty_option' => $this->t('--Selectionnez une entreprise--'),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entrepriseId,
    );
    
    $form['type_permis_env_label'] = array(
    		'#markup' => '<b>1.	Type de permis ou autorisation environnementale</b><br>'.
    			t('Indiquez le type de permis ou autorisation environnementale en cours de demande ou octroyée pour le projet'),
    );
    
    
    
    $type_permis_env= array( 
    		'aucun' => t('Aucun'), 
    		'enc_pe' => t('En cours de demande : Permis environnemental'), 
    		'enc_ae' => t('En cours de demande : Autorisation environnementale'),
    		'oc_pe' => t('Octroyé : Permis environnemental'),
    		'oc_ae' => t('Octroyée : Autorisation environnementale'),
    );
    
    $form['type_permis_env_label']['type_permis_env'] = array(
    		'#type' => 'radios',
    		'#options' => $type_permis_env,
    		'#required' => true,
    );
    
    $form['type_permis_env_label']['type_permis_env']['#default_value'] = 'aucun';
    if ($entity->getEncAe()) {
    	$form['type_permis_env_label']['type_permis_env']['#default_value'] = 'enc_ae';
    }
    
    if ($entity->getEncPe()) {
    	$form['type_permis_env_label']['type_permis_env']['#default_value'] = 'enc_pe';
    }
    if ($entity->getOcAe()) {
    	$form['type_permis_env_label']['type_permis_env']['#default_value'] = 'oc_ae';
    }
    
    if ($entity->getOcPe()) {
    	$form['type_permis_env_label']['type_permis_env']['#default_value'] = 'oc_pe';
    }
    
    
    
    $form['autorite_label'] = array(
    		'#markup' => '<b>2.	Autorité chargée de la délivrance du permis ou autorisation environnementale</b><br>'.
    		'Indiquez l’autorité qui est chargée de la délivrance du permis ou autorisation environnementale demandée ou octroyée pour le projet'
    		
    );
    
    $autorite = array(
    		'one' => t('Office national pour l’environnement (ONE)'), 
    		'ministere' => t('Ministère'),);
    $form['autorite_label']['autorite'] = array(
    		'#type' => 'radios',
    		'#title' => "Autorité",
    		'#options' => $autorite,
    		'#required' => true,
    ); 
    
    if ($entity->getOne()) {
    	$form['autorite_label']['autorite']['#default_value'] = 'one';
    }
    
    if ($entity->getMinistere()) {
    	$form['autorite_label']['autorite']['#default_value'] = 'ministere';
    }
    
    
    
     
    $form['numero_permis'] = array(
    		'#title' => "3. Numéros de permis ou environnemental délivré",
    		'#description' => 'Préciser le numéro du permis ou autorisation environnementale pour le projet',
    		'#type' => 'textfield',
    		'#required' => true,
    		'#default_value' => $entity->getNumeroPermis(),
    );
    
    
    $form['annee_obtention'] = array(
    		'#title' => "4. Année d’obtention du permis ou autorisation environnementale",
    		'#description' => 'Indiquez l’année d’obtention du permis ou autorisation',
    		'#type' => 'number',
    		'#required' => true,
    		'#default_value' => $entity->getAnneeObtention(),
    		'#min' => 1990,
    		'#max' => 2030,
    );
    
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
    
    $field = $form_state->getValue('type_permis_env');
    $entity->setTypePermisEnv($field);
    
    
    $field = $form_state->getValue('autorite');
    $entity->setAutorite($field);
    
    
    $entreprise_id = $form_state->getValue('entreprise_id');
    $numero_permis = $form_state->getValue('numero_permis');
    $dt = date('Y/m/d h:m:s');
    $name = $entreprise_id . " - ".$numero_permis." - ".$dt;
    $entity->setName($name);
    
    
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
