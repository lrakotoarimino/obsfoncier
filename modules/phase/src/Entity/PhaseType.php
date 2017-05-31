<?php

namespace Drupal\phase\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Phase type entity.
 *
 * @ConfigEntityType(
 *   id = "phase_type",
 *   label = @Translation("Phase type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\phase\PhaseTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\phase\Form\PhaseTypeForm",
 *       "edit" = "Drupal\phase\Form\PhaseTypeForm",
 *       "delete" = "Drupal\phase\Form\PhaseTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\phase\PhaseTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "phase_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "phase",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/phase_type/{phase_type}",
 *     "add-form" = "/admin/structure/phase_type/add",
 *     "edit-form" = "/admin/structure/phase_type/{phase_type}/edit",
 *     "delete-form" = "/admin/structure/phase_type/{phase_type}/delete",
 *     "collection" = "/admin/structure/phase_type"
 *   }
 * )
 */
class PhaseType extends ConfigEntityBundleBase implements PhaseTypeInterface {

  /**
   * The Phase type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Phase type label.
   *
   * @var string
   */
  protected $label;

}
