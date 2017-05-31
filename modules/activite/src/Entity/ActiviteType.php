<?php

namespace Drupal\activite\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Activite type entity.
 *
 * @ConfigEntityType(
 *   id = "activite_type",
 *   label = @Translation("Activite type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\activite\ActiviteTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\activite\Form\ActiviteTypeForm",
 *       "edit" = "Drupal\activite\Form\ActiviteTypeForm",
 *       "delete" = "Drupal\activite\Form\ActiviteTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\activite\ActiviteTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "activite_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "activite",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/activite_type/{activite_type}",
 *     "add-form" = "/admin/structure/activite_type/add",
 *     "edit-form" = "/admin/structure/activite_type/{activite_type}/edit",
 *     "delete-form" = "/admin/structure/activite_type/{activite_type}/delete",
 *     "collection" = "/admin/structure/activite_type"
 *   }
 * )
 */
class ActiviteType extends ConfigEntityBundleBase implements ActiviteTypeInterface {

  /**
   * The Activite type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Activite type label.
   *
   * @var string
   */
  protected $label;

}
