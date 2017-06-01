<?php

namespace Drupal\permisautorisation\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Permisautorisation entity.
 *
 * @ingroup permisautorisation
 *
 * @ContentEntityType(
 *   id = "permisautorisation",
 *   label = @Translation("Permisautorisation"),
 *   bundle_label = @Translation("Permisautorisation type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\permisautorisation\PermisautorisationListBuilder",
 *     "views_data" = "Drupal\permisautorisation\Entity\PermisautorisationViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\permisautorisation\Form\PermisautorisationForm",
 *       "add" = "Drupal\permisautorisation\Form\PermisautorisationForm",
 *       "edit" = "Drupal\permisautorisation\Form\PermisautorisationForm",
 *       "delete" = "Drupal\permisautorisation\Form\PermisautorisationDeleteForm",
 *     },
 *     "access" = "Drupal\permisautorisation\PermisautorisationAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\permisautorisation\PermisautorisationHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "permisautorisation",
 *   admin_permission = "administer permisautorisation entities",
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
 *     "canonical" = "/admin/structure/permisautorisation/{permisautorisation}",
 *     "add-page" = "/admin/structure/permisautorisation/add",
 *     "add-form" = "/admin/structure/permisautorisation/add/{permisautorisation_type}",
 *     "edit-form" = "/admin/structure/permisautorisation/{permisautorisation}/edit",
 *     "delete-form" = "/admin/structure/permisautorisation/{permisautorisation}/delete",
 *     "collection" = "/admin/structure/permisautorisation",
 *   },
 *   bundle_entity_type = "permisautorisation_type",
 *   field_ui_base_route = "entity.permisautorisation_type.edit_form"
 * )
 */
class Permisautorisation extends ContentEntityBase implements PermisautorisationInterface {

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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Permisautorisation entity.'))
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
      ->setDescription(t('The name of the Permisautorisation entity.'))
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
      ->setDescription(t('A boolean indicating whether the Permisautorisation is published.'))
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
      
      
    return $fields;
  }

}
