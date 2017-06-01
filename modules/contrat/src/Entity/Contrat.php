<?php

namespace Drupal\contrat\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Contrat entity.
 *
 * @ingroup contrat
 *
 * @ContentEntityType(
 *   id = "contrat",
 *   label = @Translation("Contrat"),
 *   bundle_label = @Translation("Contrat type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\contrat\ContratListBuilder",
 *     "views_data" = "Drupal\contrat\Entity\ContratViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\contrat\Form\ContratForm",
 *       "add" = "Drupal\contrat\Form\ContratForm",
 *       "edit" = "Drupal\contrat\Form\ContratForm",
 *       "delete" = "Drupal\contrat\Form\ContratDeleteForm",
 *     },
 *     "access" = "Drupal\contrat\ContratAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\contrat\ContratHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "contrat",
 *   admin_permission = "administer contrat entities",
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
 *     "canonical" = "/admin/structure/contrat/{contrat}",
 *     "add-page" = "/admin/structure/contrat/add",
 *     "add-form" = "/admin/structure/contrat/add/{contrat_type}",
 *     "edit-form" = "/admin/structure/contrat/{contrat}/edit",
 *     "delete-form" = "/admin/structure/contrat/{contrat}/delete",
 *     "collection" = "/admin/structure/contrat",
 *   },
 *   bundle_entity_type = "contrat_type",
 *   field_ui_base_route = "entity.contrat_type.edit_form"
 * )
 */
class Contrat extends ContentEntityBase implements ContratInterface {

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
  public function setMotifavenantId($motifavenant_id) {
  	$this->set('motifavenant_id', $motifavenant_id);
  	return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getMotifavenantId() {
  	return $this->get('motifavenant_id')->target_id;
  }
  

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Contrat entity.'))
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
      ->setDescription(t('The name of the Contrat entity.'))
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
      ->setDescription(t('A boolean indicating whether the Contrat is published.'))
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
      
    $fields['motifavenant_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID Motif avenant'))
      ->setDescription(t('ID Motif avenant.'))
      ->setSetting('target_type', 'motifavenant');
      
    return $fields;
  }

}
