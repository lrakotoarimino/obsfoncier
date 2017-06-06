<?php

namespace Drupal\travaux\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Liste des travaux type entity.
 *
 * @ConfigEntityType(
 *   id = "travaux_type",
 *   label = @Translation("Liste des travaux type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\travaux\TravauxTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\travaux\Form\TravauxTypeForm",
 *       "edit" = "Drupal\travaux\Form\TravauxTypeForm",
 *       "delete" = "Drupal\travaux\Form\TravauxTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\travaux\TravauxTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "travaux_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "travaux",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/travaux_type/{travaux_type}",
 *     "add-form" = "/admin/structure/travaux_type/add",
 *     "edit-form" = "/admin/structure/travaux_type/{travaux_type}/edit",
 *     "delete-form" = "/admin/structure/travaux_type/{travaux_type}/delete",
 *     "collection" = "/admin/structure/travaux_type"
 *   }
 * )
 */
class TravauxType extends ConfigEntityBundleBase implements TravauxTypeInterface {

  /**
   * The Liste des travaux type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Liste des travaux type label.
   *
   * @var string
   */
  protected $label;

}
