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
    
    $options = getOptions('entreprise');
    
    $form['entreprise_id'] = array(
    		'#title' => $this->t("Entreprise"),
    		'#type' => 'hidden',
    		'#empty_option' => $this->t('--Selectionnez une entreprise--'),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entrepriseId,
    );
    
    $form['annee_negociation'] = array(
    		'#title' => "Année du début de négociation du contrat pour accès à la terre",
    		'#type' => 'number',
    		'#required' => true,
    		'#default_value' => $entity->getAnneeNegociation(),
    		'#min' => 1990,
    		'#max' => 2030,
    );
    
    $form['annee_signature'] = array(
    		'#title' => "Année de la signature du contrat pour accès à la terre",
    		'#type' => 'number',
    		'#required' => true,
    		'#default_value' => $entity->getAnneeSignature(),
    		'#min' => 1990,
    		'#max' => 2030,
    );
    
    $form['annee_rupture'] = array(
    		'#title' => "Année de la rupture du contrat pour accès à la terre",
    		'#type' => 'number',
    		'#required' => true,
    		'#default_value' => $entity->getAnneeRupture(),
    		'#min' => 1990,
    		'#max' => 2030,
    );
    
    $form['motif_rupture'] = array(
    		'#title' => "Motif de la rupture du contrat pour accès à la terre",
    		'#description' => 'Indiquez le motif de la rupture du contrat entre l’Etat et l’investisseur',
    		'#type' => 'textfield',
    		'#required' => true,
    		'#default_value' => $entity->getMotifRupture(),
    );
    
    $form['annee_renouvellement'] = array(
    		'#title' => "Année de renouvellement du contrat pour accès à la terre ",
    		'#type' => 'number',
    		'#required' => true,
    		'#default_value' => $entity->getAnneeRenouvellement(),
    		'#min' => 1990,
    		'#max' => 2030,
    );
    
    
    $form['motif_renouvellement'] = array(
    		'#title' => "Motif du renouvellement du contrat pour accès à la terre",
    		'#description' => 'Indiquer le motif du renouvellement du contrat entre l’Etat et l’investisseur',
    		'#type' => 'textfield',
    		'#required' => true,
    		'#default_value' => $entity->getMotifRenouvellement(),
    );
    
    
    $options = getOptions('motifavenant');
    $form['motifavenant_id'] = array(
    		'#title' => $this->t("Motif avenant"),
    		'#type' => 'select',
    		'#empty_option' => $this->t("--Selectionnez un motif de l'avenant--"),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entity->getMotifavenantId(),
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
