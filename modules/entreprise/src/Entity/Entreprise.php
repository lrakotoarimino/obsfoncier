<?php

namespace Drupal\entreprise\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Entreprise entity.
 *
 * @ingroup entreprise
 *
 * @ContentEntityType(
 *   id = "entreprise",
 *   label = @Translation("Entreprise"),
 *   bundle_label = @Translation("Entreprise type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\entreprise\EntrepriseListBuilder",
 *     "views_data" = "Drupal\entreprise\Entity\EntrepriseViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\entreprise\Form\EntrepriseForm",
 *       "add" = "Drupal\entreprise\Form\EntrepriseForm",
 *       "edit" = "Drupal\entreprise\Form\EntrepriseForm",
 *       "delete" = "Drupal\entreprise\Form\EntrepriseDeleteForm",
 *     },
 *     "access" = "Drupal\entreprise\EntrepriseAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\entreprise\EntrepriseHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "entreprise",
 *   admin_permission = "administer entreprise entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/entreprise/{entreprise}",
 *     "add-page" = "/admin/structure/entreprise/add",
 *     "add-form" = "/admin/structure/entreprise/add/{entreprise_type}",
 *     "edit-form" = "/admin/structure/entreprise/{entreprise}/edit",
 *     "delete-form" = "/admin/structure/entreprise/{entreprise}/delete",
 *     "collection" = "/admin/structure/entreprise",
 *   },
 *   bundle_entity_type = "entreprise_type",
 *   field_ui_base_route = "entity.entreprise_type.edit_form"
 * )
 */
class Entreprise extends ContentEntityBase implements EntrepriseInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }
  
   /**
   * {@inheritdoc}
   */
   public function getAdresse() {
   	return $this->get('adresse')->value;
   }
   
   /**
    * {@inheritdoc}
    */
   /*public function getCdEntreprise() {
   	return $this->get('cd_entreprise')->value;
   }*/
   

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setAdresse($adresse) {
  	$this->set('adresse', $adresse);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  /*public function setCdEntreprise($cd_entreprise) {
  	$this->set('cd_entreprise', $cd_entreprise);
  	return $this;
  }*/
  

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }
  
  

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setCdProjet($cd_projet) {
  	$this->set('cd_projet', $cd_projet);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getCdProjet() {
  	return $this->get('cd_projet')->value;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setSecteurId($secteur_id) {
  	$this->set('secteur_id', $secteur_id);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getSecteurId() {
  	return $this->get('secteur_id')->target_id;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setPhaseId($phase_id) {
  	$this->set('phase_id', $phase_id);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getPhaseId() {
  	return $this->get('phase_id')->target_id;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setFormeJuridiqueId($formejuridique_id) {
  	$this->set('formejuridique_id', $formejuridique_id);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getFormeJuridiqueId() {
  	return $this->get('formejuridique_id')->target_id;
  }
  
  
  /**
   * {@inheritdoc}
   */
  public function setActiviteId($activite_id) {
  	$this->set('activite_id', $activite_id);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getActiviteId() {
  	return $this->get('activite_id')->target_id;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setPaysId($pays_id) {
  	$this->set('pays_id', $pays_id);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getPaysId() {
  	return $this->get('pays_id')->target_id;
  }
  
  
  /**
   * {@inheritdoc}
   */
  public function setDureeProjet($duree_projet) {
  	$this->set('duree_projet', $duree_projet);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getDureeProjet() {
  	return $this->get('duree_projet')->value;
  }
  
  
  
  
  

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Entreprise entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Entreprise entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Entreprise is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));
    
    /*$fields['cd_entreprise'] = BaseFieldDefinition::create('string')
      ->setLabel(t("Code de l'entreprise"))
      ->setDescription(t("Code de l'entreprise"));*/
      
      
    $fields['adresse'] = BaseFieldDefinition::create('string')
      ->setLabel(t("Contact et adresse de l'entreprise"))
      ->setDescription(t("Contact et adresse de l'entreprise"));
    
    $fields['cd_projet'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Code Projet'))
      ->setDescription(t('Code Projet'));
      
    $fields['secteur_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID Secteur'))
      ->setDescription(t('ID Secteur.'))
      ->setSetting('target_type', 'secteur');
      
    $fields['phase_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID Phase'))
      ->setDescription(t('ID Phase.'))
      ->setSetting('target_type', 'phase');
    
    $fields['formejuridique_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID Forme juridique'))
      ->setDescription(t('ID Forme juridique.'))
      ->setSetting('target_type', 'formejuridique');
      
    $fields['activite_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID Activité'))
      ->setDescription(t('ID Activité.'))
      ->setSetting('target_type', 'activite');
      
    $fields['pays_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID Pays'))
      ->setDescription(t('ID Pays.'))
      ->setSetting('target_type', 'pays');

    $fields['duree_projet'] = BaseFieldDefinition::create('integer')
      ->setLabel(t("M4 Durée du projet (en années)"))
      ->setDescription(t("M4 Durée du projet (en années)"));
      
      
      
      
    return $fields;
  }

}
