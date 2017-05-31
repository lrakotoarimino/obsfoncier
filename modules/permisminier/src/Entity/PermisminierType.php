<?php

namespace Drupal\permisminier\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Permisminier type entity.
 *
 * @ConfigEntityType(
 *   id = "permisminier_type",
 *   label = @Translation("Permisminier type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\permisminier\PermisminierTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\permisminier\Form\PermisminierTypeForm",
 *       "edit" = "Drupal\permisminier\Form\PermisminierTypeForm",
 *       "delete" = "Drupal\permisminier\Form\PermisminierTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\permisminier\PermisminierTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "permisminier_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "permisminier",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/permisminier_type/{permisminier_type}",
 *     "add-form" = "/admin/structure/permisminier_type/add",
 *     "edit-form" = "/admin/structure/permisminier_type/{permisminier_type}/edit",
 *     "delete-form" = "/admin/structure/permisminier_type/{permisminier_type}/delete",
 *     "collection" = "/admin/structure/permisminier_type"
 *   }
 * )
 */
class PermisminierType extends ConfigEntityBundleBase implements PermisminierTypeInterface {

  /**
   * The Permisminier type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Permisminier type label.
   *
   * @var string
   */
  protected $label;

}
