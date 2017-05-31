<?php

namespace Drupal\typepermis\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Typepermis type entity.
 *
 * @ConfigEntityType(
 *   id = "typepermis_type",
 *   label = @Translation("Typepermis type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\typepermis\TypepermisTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\typepermis\Form\TypepermisTypeForm",
 *       "edit" = "Drupal\typepermis\Form\TypepermisTypeForm",
 *       "delete" = "Drupal\typepermis\Form\TypepermisTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\typepermis\TypepermisTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "typepermis_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "typepermis",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/typepermis_type/{typepermis_type}",
 *     "add-form" = "/admin/structure/typepermis_type/add",
 *     "edit-form" = "/admin/structure/typepermis_type/{typepermis_type}/edit",
 *     "delete-form" = "/admin/structure/typepermis_type/{typepermis_type}/delete",
 *     "collection" = "/admin/structure/typepermis_type"
 *   }
 * )
 */
class TypepermisType extends ConfigEntityBundleBase implements TypepermisTypeInterface {

  /**
   * The Typepermis type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Typepermis type label.
   *
   * @var string
   */
  protected $label;

}
