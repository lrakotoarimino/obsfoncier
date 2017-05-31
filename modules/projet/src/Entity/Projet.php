<?php

namespace Drupal\projet\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Projet entity.
 *
 * @ingroup projet
 *
 * @ContentEntityType(
 *   id = "projet",
 *   label = @Translation("Projet"),
 *   bundle_label = @Translation("Projet type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\projet\ProjetListBuilder",
 *     "views_data" = "Drupal\projet\Entity\ProjetViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\projet\Form\ProjetForm",
 *       "add" = "Drupal\projet\Form\ProjetForm",
 *       "edit" = "Drupal\projet\Form\ProjetForm",
 *       "delete" = "Drupal\projet\Form\ProjetDeleteForm",
 *     },
 *     "access" = "Drupal\projet\ProjetAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\projet\ProjetHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "projet",
 *   admin_permission = "administer projet entities",
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
 *     "canonical" = "/admin/structure/projet/{projet}",
 *     "add-page" = "/admin/structure/projet/add",
 *     "add-form" = "/admin/structure/projet/add/{projet_type}",
 *     "edit-form" = "/admin/structure/projet/{projet}/edit",
 *     "delete-form" = "/admin/structure/projet/{projet}/delete",
 *     "collection" = "/admin/structure/projet",
 *   },
 *   bundle_entity_type = "projet_type",
 *   field_ui_base_route = "entity.projet_type.edit_form"
 * )
 */
class Projet extends ContentEntityBase implements ProjetInterface {

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
  public function getEntrepriseId() {
  	return $this->get('entreprise_id')->value;
  }

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
  public function setEntrepriseid($entreprise_id) {
  	$this->set('entreprise_id', $entreprise_id);
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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Projet entity.'))
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
      ->setDescription(t('The name of the Projet entity.'))
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
      ->setDescription(t('A boolean indicating whether the Projet is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

      
    $fields['entreprise_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID Entreprise'))
      ->setDescription(t('ID Entreprise.'))
      ->setSetting('target_type', 'entreprise');
     
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
	 
      
      
    return $fields;
  }

}
