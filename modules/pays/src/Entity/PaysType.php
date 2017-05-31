<?php

namespace Drupal\pays\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Pays type entity.
 *
 * @ConfigEntityType(
 *   id = "pays_type",
 *   label = @Translation("Pays type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\pays\PaysTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\pays\Form\PaysTypeForm",
 *       "edit" = "Drupal\pays\Form\PaysTypeForm",
 *       "delete" = "Drupal\pays\Form\PaysTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\pays\PaysTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "pays_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "pays",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/pays_type/{pays_type}",
 *     "add-form" = "/admin/structure/pays_type/add",
 *     "edit-form" = "/admin/structure/pays_type/{pays_type}/edit",
 *     "delete-form" = "/admin/structure/pays_type/{pays_type}/delete",
 *     "collection" = "/admin/structure/pays_type"
 *   }
 * )
 */
class PaysType extends ConfigEntityBundleBase implements PaysTypeInterface {

  /**
   * The Pays type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Pays type label.
   *
   * @var string
   */
  protected $label;

}
