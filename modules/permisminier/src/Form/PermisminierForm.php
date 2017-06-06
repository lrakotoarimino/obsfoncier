<?php

namespace Drupal\permisminier\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Permisminier edit forms.
 *
 * @ingroup permisminier
 */
class PermisminierForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\permisminier\Entity\Permisminier */
    $form = parent::buildForm($form, $form_state);
    
    
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
    
    $form["1-line-col2-1"] = array('#markup' => '<div class="row" style="margin-top: 10px;"><div class="col-md-6">');
    
    
    $form['num_permis'] = array(
    		'#title' => $this->t("Numéros de permis minier ou autorisation"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getNumPermis(),
    );
    
    $form["1-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    $nidTypePermis = \Drupal::entityQuery('typepermis')
    ->execute();
    $typepermiss = \Drupal::entityTypeManager()->getStorage('typepermis')->loadMultiple($nidTypePermis);
    foreach ($typepermiss as $nid => $typepermis) {
    	$options[$nid] = $typepermis->get('name')->getValue()['0']['value'];
    }
    asort($options);
    
    $form['typepermis_id'] = array(
    		'#title' => $this->t("Type de permis minier ou autorisation"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez un type de permis--'),
    		'#options' => $options,
    		'#required' => true,
    		'#default_value' => $entity->getTypePermisId(),
    );
    
    $form["2-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div class="col-md-6">');
    
    $form['dt_delivrance'] = array(
    		'#title' => $this->t("Date de délivrance du permis minier"),
    		'#type' => 'date',
    		'#default_value' => $entity->getDtDelivrance(),
    );

   
    $form["2-line-col2-2"] = array('#markup' => '</div><div class="col-md-6">');
    
    $form['dt_expiration'] = array(
    		'#title' => $this->t("Date d'expiration du permis minier"),
    		'#type' => 'date',
    		'#default_value' => $entity->getDtExpiration(),
    );
    
    
    $form["3-line-col2-1"] = array('#markup' => '</div></div><div class="row"><div>&nbsp;</div></div>');
    
    //On cache l'auteur
    $form['user_id']['#access'] = FALSE;
    
    //On cache le nom
    $form['name']['#access'] = FALSE;
    
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
        drupal_set_message($this->t('Created the %label Permisminier.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Permisminier.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.permisminier.canonical', ['permisminier' => $entity->id()]);
  }

}
