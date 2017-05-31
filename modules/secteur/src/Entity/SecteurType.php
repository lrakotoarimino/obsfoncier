<?php

namespace Drupal\secteur\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Secteur type entity.
 *
 * @ConfigEntityType(
 *   id = "secteur_type",
 *   label = @Translation("Secteur type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\secteur\SecteurTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\secteur\Form\SecteurTypeForm",
 *       "edit" = "Drupal\secteur\Form\SecteurTypeForm",
 *       "delete" = "Drupal\secteur\Form\SecteurTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\secteur\SecteurTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "secteur_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "secteur",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/secteur_type/{secteur_type}",
 *     "add-form" = "/admin/structure/secteur_type/add",
 *     "edit-form" = "/admin/structure/secteur_type/{secteur_type}/edit",
 *     "delete-form" = "/admin/structure/secteur_type/{secteur_type}/delete",
 *     "collection" = "/admin/structure/secteur_type"
 *   }
 * )
 */
class SecteurType extends ConfigEntityBundleBase implements SecteurTypeInterface {

  /**
   * The Secteur type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Secteur type label.
   *
   * @var string
   */
  protected $label;

}
