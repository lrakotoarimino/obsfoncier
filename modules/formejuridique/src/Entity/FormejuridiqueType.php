<?php

namespace Drupal\formejuridique\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Formejuridique type entity.
 *
 * @ConfigEntityType(
 *   id = "formejuridique_type",
 *   label = @Translation("Formejuridique type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\formejuridique\FormejuridiqueTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\formejuridique\Form\FormejuridiqueTypeForm",
 *       "edit" = "Drupal\formejuridique\Form\FormejuridiqueTypeForm",
 *       "delete" = "Drupal\formejuridique\Form\FormejuridiqueTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\formejuridique\FormejuridiqueTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "formejuridique_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "formejuridique",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/formejuridique_type/{formejuridique_type}",
 *     "add-form" = "/admin/structure/formejuridique_type/add",
 *     "edit-form" = "/admin/structure/formejuridique_type/{formejuridique_type}/edit",
 *     "delete-form" = "/admin/structure/formejuridique_type/{formejuridique_type}/delete",
 *     "collection" = "/admin/structure/formejuridique_type"
 *   }
 * )
 */
class FormejuridiqueType extends ConfigEntityBundleBase implements FormejuridiqueTypeInterface {

  /**
   * The Formejuridique type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Formejuridique type label.
   *
   * @var string
   */
  protected $label;

}
