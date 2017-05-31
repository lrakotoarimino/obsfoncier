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
    		'#default_value' => $entity->getEntrepriseId(),
    );
    
    $form['num_permis'] = array(
    		'#title' => $this->t("Numéro du permis minier"),
    		'#type' => 'textfield',
    		'#default_value' => $entity->getNumPermis(),
    );
    
    
    
    $nidTypePermis = \Drupal::entityQuery('typepermis')
    ->execute();
    $typepermiss = \Drupal::entityTypeManager()->getStorage('typepermis')->loadMultiple($nidTypePermis);
    foreach ($typepermiss as $nid => $typepermis) {
    	$options[$nid] = $typepermis->get('name')->getValue()['0']['value'];
    }
    asort($options);
    
    $form['typepermis_id'] = array(
    		'#title' => $this->t("Type de permis"),
    		'#type' => 'select',
    		'#empty_option' => $this->t('--Selectionnez un type de permis--'),
    		'#options' => $options,
    		'#required' => false,
    		'#default_value' => $entity->getTypePermisId(),
    );
    
    $form['dt_delivrance'] = array(
    		'#title' => $this->t("Date de délivrance du permis minier"),
    		'#type' => 'date',
    		'#default_value' => $entity->getDtDelivrance(),
    );

   
    $form['dt_expiration'] = array(
    		'#title' => $this->t("Date d'expiration du permis minier"),
    		'#type' => 'date',
    		'#default_value' => $entity->getDtExpiration(),
    );
    
    //On cache l'auteur
    $form['user_id']['#access'] = FALSE;
    
    //On cache le nom
    $form['name']['#access'] = FALSE;

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
