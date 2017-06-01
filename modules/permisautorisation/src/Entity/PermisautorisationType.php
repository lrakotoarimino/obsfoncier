<?php

namespace Drupal\permisautorisation\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Permisautorisation type entity.
 *
 * @ConfigEntityType(
 *   id = "permisautorisation_type",
 *   label = @Translation("Permisautorisation type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\permisautorisation\PermisautorisationTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\permisautorisation\Form\PermisautorisationTypeForm",
 *       "edit" = "Drupal\permisautorisation\Form\PermisautorisationTypeForm",
 *       "delete" = "Drupal\permisautorisation\Form\PermisautorisationTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\permisautorisation\PermisautorisationTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "permisautorisation_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "permisautorisation",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/permisautorisation_type/{permisautorisation_type}",
 *     "add-form" = "/admin/structure/permisautorisation_type/add",
 *     "edit-form" = "/admin/structure/permisautorisation_type/{permisautorisation_type}/edit",
 *     "delete-form" = "/admin/structure/permisautorisation_type/{permisautorisation_type}/delete",
 *     "collection" = "/admin/structure/permisautorisation_type"
 *   }
 * )
 */
class PermisautorisationType extends ConfigEntityBundleBase implements PermisautorisationTypeInterface {

  /**
   * The Permisautorisation type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Permisautorisation type label.
   *
   * @var string
   */
  protected $label;

}
