<?php

namespace Drupal\entreprise\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Entreprise type entity.
 *
 * @ConfigEntityType(
 *   id = "entreprise_type",
 *   label = @Translation("Entreprise type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\entreprise\EntrepriseTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\entreprise\Form\EntrepriseTypeForm",
 *       "edit" = "Drupal\entreprise\Form\EntrepriseTypeForm",
 *       "delete" = "Drupal\entreprise\Form\EntrepriseTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\entreprise\EntrepriseTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "entreprise_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "entreprise",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/entreprise_type/{entreprise_type}",
 *     "add-form" = "/admin/structure/entreprise_type/add",
 *     "edit-form" = "/admin/structure/entreprise_type/{entreprise_type}/edit",
 *     "delete-form" = "/admin/structure/entreprise_type/{entreprise_type}/delete",
 *     "collection" = "/admin/structure/entreprise_type"
 *   }
 * )
 */
class EntrepriseType extends ConfigEntityBundleBase implements EntrepriseTypeInterface {

  /**
   * The Entreprise type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Entreprise type label.
   *
   * @var string
   */
  protected $label;

}
