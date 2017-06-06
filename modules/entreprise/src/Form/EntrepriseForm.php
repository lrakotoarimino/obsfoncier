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
    //kint($form_state);//
    //$form['name']['#title'] = 'Entrep xxx';
    $entity = $this->entity;
    
    /*$form['cd_entreprise'] = array(
    		'#title' => $this->t("Code de l'entreprise"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getCdEntreprise(),
    );*/
    
    
    $form['entreprise_id'] = array(
    		'#type' => 'hidden',
    );
    
    
    $form["1-line-col2-1"] = array('#markup' => '<div class="row" style="margin-top: 10px;"><div class="col-md-6">');
    
    $form['adresse'] = array(
    		'#title' => $this->t("Contact et adresse de l'entreprise"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getAdresse(),
    );
    
    $form["1-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    
    $form['cd_projet'] = array(
    		'#title' => $this->t("Code du projet"),
    		'#type' => 'textfield',
    		'#required' => true,
    		'#default_value' => $entity->getCdProjet(),
    );
    $form["2-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div class="col-md-6">');
    
    
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
    
    
    
    
    $form["2-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    
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
    
    
    
    $form["3-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div class="col-md-6">');
    
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
    
   
    $form["3-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    
    
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
    
    
   
    
    $form["4-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div class="col-md-6">');
    
    $form['emploi_local'] = array(
    		'#title' => $this->t("M19 Emploi local créé et à créer annuellement"),
    		'#type' => 'textarea',
    		'#default_value' => $entity->getEmploiLocal(),
    );
    
    
    $form["4-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    $form['infra_accompagnement'] = array(
    		'#title' => $this->t("M20 Infrastructure et accompagnement social prévus"),
    		'#type' => 'textarea',
    		'#default_value' => $entity->getInfraAccompagnement(),
    );
    
    
    
    $form["5-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div class="col-md-6">');
    
    
    
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
    
    
   
    
    $form["5-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    $form['duree_projet'] = array(
    		'#title' => $this->t("M4 Durée du projet (en années)"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getDureeProjet(),
    );
    
    $form["6-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div class="col-md-6">');
    
    $form['destination_prod'] = array(
    		'#title' => $this->t("M3 Destination des produits"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getDestinationProd(),
    );
    
    $form["6-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    $form['montant_invest'] = array(
    		'#title' => $this->t("M6 Montant à investir (en ariary)"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getMontantInvest(),
    );
    
    
    $form["7-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div class="col-md-6">');
    
    $form['plan_amenagement_soumis'] = array(
    		'#title' => $this->t("M7.1 Plan d’aménagement du projet soumis à la DGAT/OAT"),
    		'#type' => 'textarea',
    		'#default_value' => $entity->getPlanAmenagementSoumis(),
    );
    
    $form["7-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    $form['plan_amenagement_valide'] = array(
    		'#title' => $this->t("M7.2 Plan d’aménagement du projet validé par la DGAT/OAT "),
    		'#type' => 'textarea',
    		'#default_value' => $entity->getPlanAmenagementValide(),
    );
    
    $form["8-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div class="col-md-6">');
    
    $form['regime_invest'] = array(
    		'#title' => $this->t("M9  Régime de l’investisseur "),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getRegimeInvest(),
    );
    
   
    
    $form["x-line-col2-1"] = array('#markup' => '</div><div>&nbsp;</div>');
    
    //On cache l'auteur
    $form['user_id']['#access'] = FALSE;
    
    $form['actions']['back']= array(
    		'#type' => 'button',
    		'#value' => $this->t("Retour"),
    		'#weight' => 10, 
    		'#attributes' => array('onclick' => 'window.history.back();return false;',),
    );
   
   // $form["5-line-col2-2"] = array('#markup' => '</div>');

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
