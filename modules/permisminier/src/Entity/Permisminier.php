<?php

namespace Drupal\permisminier\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Permisminier entity.
 *
 * @ingroup permisminier
 *
 * @ContentEntityType(
 *   id = "permisminier",
 *   label = @Translation("Permisminier"),
 *   bundle_label = @Translation("Permisminier type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\permisminier\PermisminierListBuilder",
 *     "views_data" = "Drupal\permisminier\Entity\PermisminierViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\permisminier\Form\PermisminierForm",
 *       "add" = "Drupal\permisminier\Form\PermisminierForm",
 *       "edit" = "Drupal\permisminier\Form\PermisminierForm",
 *       "delete" = "Drupal\permisminier\Form\PermisminierDeleteForm",
 *     },
 *     "access" = "Drupal\permisminier\PermisminierAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\permisminier\PermisminierHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "permisminier",
 *   admin_permission = "administer permisminier entities",
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
 *     "canonical" = "/admin/structure/permisminier/{permisminier}",
 *     "add-page" = "/admin/structure/permisminier/add",
 *     "add-form" = "/admin/structure/permisminier/add/{permisminier_type}/{entreprise_id}",
 *     "edit-form" = "/admin/structure/permisminier/{permisminier}/edit",
 *     "delete-form" = "/admin/structure/permisminier/{permisminier}/delete",
 *     "collection" = "/admin/structure/permisminier",
 *   },
 *   bundle_entity_type = "permisminier_type",
 *   field_ui_base_route = "entity.permisminier_type.edit_form"
 * )
 */
class Permisminier extends ContentEntityBase implements PermisminierInterface {

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
  public function getEntrepriseId() {
  	return $this->get('entreprise_id')->target_id;
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
  public function getNumPermis() {
  	return $this->get('num_permis')->value;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setNumPermis($num_permis) {
  	$this->set('num_permis', $num_permis);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getTypePermisId() {
  	return $this->get('typepermis_id')->target_id;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setTypePermisId($typepermis) {
  	$this->set('typepermis_id', $typepermis);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getDtDelivrance() {
  	return $this->get('dt_delivrance')->value;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setDtDelivrance($dt_delivrance) {
  	$this->set('dt_delivrance', $dt_delivrance);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getDtExpiration() {
  	return $this->get('dt_expiration')->value;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setDtExpiration($dt_expiration) {
  	$this->set('dt_expiration', $dt_expiration);
  	return $this;
  }
  
  

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Permisminier entity.'))
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
      ->setDescription(t('The name of the Permisminier entity.'))
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
      ->setDescription(t('A boolean indicating whether the Permisminier is published.'))
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
    
      
    $fields['num_permis'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Numéro de permis minier'))
      ->setDescription(t('Numéro de permis minier'));
      
    $fields['typepermis_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID Type de permis minier'))
      ->setDescription(t('ID Type de permis minier.'))
      ->setSetting('target_type', 'typepermis');
    
    $fields['dt_delivrance'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Date de délivrance du permis minier'))
      ->setDescription(t('Date de délivrance du permis minier'))
      ->setSetting('datetime_type', 'date');
    
      
    $fields['dt_expiration'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Date expiration du permis minier'))
      ->setDescription(t('Date expiration du permis minier'))
      ->setSetting('datetime_type', 'date');
      
    return $fields;
  }

}
