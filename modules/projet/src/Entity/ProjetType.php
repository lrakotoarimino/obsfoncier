<?php

namespace Drupal\projet\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Projet type entity.
 *
 * @ConfigEntityType(
 *   id = "projet_type",
 *   label = @Translation("Projet type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\projet\ProjetTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\projet\Form\ProjetTypeForm",
 *       "edit" = "Drupal\projet\Form\ProjetTypeForm",
 *       "delete" = "Drupal\projet\Form\ProjetTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\projet\ProjetTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "projet_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "projet",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/projet_type/{projet_type}",
 *     "add-form" = "/admin/structure/projet_type/add",
 *     "edit-form" = "/admin/structure/projet_type/{projet_type}/edit",
 *     "delete-form" = "/admin/structure/projet_type/{projet_type}/delete",
 *     "collection" = "/admin/structure/projet_type"
 *   }
 * )
 */
class ProjetType extends ConfigEntityBundleBase implements ProjetTypeInterface {

  /**
   * The Projet type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Projet type label.
   *
   * @var string
   */
  protected $label;

}
