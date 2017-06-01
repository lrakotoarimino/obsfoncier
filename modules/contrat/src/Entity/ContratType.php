<?php

namespace Drupal\contrat\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Contrat type entity.
 *
 * @ConfigEntityType(
 *   id = "contrat_type",
 *   label = @Translation("Contrat type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\contrat\ContratTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\contrat\Form\ContratTypeForm",
 *       "edit" = "Drupal\contrat\Form\ContratTypeForm",
 *       "delete" = "Drupal\contrat\Form\ContratTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\contrat\ContratTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "contrat_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "contrat",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/contrat_type/{contrat_type}",
 *     "add-form" = "/admin/structure/contrat_type/add",
 *     "edit-form" = "/admin/structure/contrat_type/{contrat_type}/edit",
 *     "delete-form" = "/admin/structure/contrat_type/{contrat_type}/delete",
 *     "collection" = "/admin/structure/contrat_type"
 *   }
 * )
 */
class ContratType extends ConfigEntityBundleBase implements ContratTypeInterface {

  /**
   * The Contrat type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Contrat type label.
   *
   * @var string
   */
  protected $label;

}
