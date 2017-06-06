<?php

namespace Drupal\contractualisation\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Contractualisation type entity.
 *
 * @ConfigEntityType(
 *   id = "contractualisation_type",
 *   label = @Translation("Contractualisation type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\contractualisation\contractualisationTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\contractualisation\Form\contractualisationTypeForm",
 *       "edit" = "Drupal\contractualisation\Form\contractualisationTypeForm",
 *       "delete" = "Drupal\contractualisation\Form\contractualisationTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\contractualisation\contractualisationTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "contractualisation_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "contractualisation",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/contractualisation_type/{contractualisation_type}",
 *     "add-form" = "/admin/structure/contractualisation_type/add",
 *     "edit-form" = "/admin/structure/contractualisation_type/{contractualisation_type}/edit",
 *     "delete-form" = "/admin/structure/contractualisation_type/{contractualisation_type}/delete",
 *     "collection" = "/admin/structure/contractualisation_type"
 *   }
 * )
 */
class contractualisationType extends ConfigEntityBundleBase implements contractualisationTypeInterface {

  /**
   * The Contractualisation type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Contractualisation type label.
   *
   * @var string
   */
  protected $label;

}
