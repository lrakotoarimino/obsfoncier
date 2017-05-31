<?php

namespace Drupal\motifavenant\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Motifavenant type entity.
 *
 * @ConfigEntityType(
 *   id = "motifavenant_type",
 *   label = @Translation("Motifavenant type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\motifavenant\MotifavenantTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\motifavenant\Form\MotifavenantTypeForm",
 *       "edit" = "Drupal\motifavenant\Form\MotifavenantTypeForm",
 *       "delete" = "Drupal\motifavenant\Form\MotifavenantTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\motifavenant\MotifavenantTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "motifavenant_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "motifavenant",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/motifavenant_type/{motifavenant_type}",
 *     "add-form" = "/admin/structure/motifavenant_type/add",
 *     "edit-form" = "/admin/structure/motifavenant_type/{motifavenant_type}/edit",
 *     "delete-form" = "/admin/structure/motifavenant_type/{motifavenant_type}/delete",
 *     "collection" = "/admin/structure/motifavenant_type"
 *   }
 * )
 */
class MotifavenantType extends ConfigEntityBundleBase implements MotifavenantTypeInterface {

  /**
   * The Motifavenant type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Motifavenant type label.
   *
   * @var string
   */
  protected $label;

}
