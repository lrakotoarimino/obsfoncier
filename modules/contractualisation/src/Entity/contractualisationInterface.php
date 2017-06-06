<?php

namespace Drupal\contractualisation\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Contractualisation entities.
 *
 * @ingroup contractualisation
 */
interface contractualisationInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Contractualisation name.
   *
   * @return string
   *   Name of the Contractualisation.
   */
  public function getName();

  /**
   * Sets the Contractualisation name.
   *
   * @param string $name
   *   The Contractualisation name.
   *
   * @return \Drupal\contractualisation\Entity\contractualisationInterface
   *   The called Contractualisation entity.
   */
  public function setName($name);

  /**
   * Gets the Contractualisation creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Contractualisation.
   */
  public function getCreatedTime();

  /**
   * Sets the Contractualisation creation timestamp.
   *
   * @param int $timestamp
   *   The Contractualisation creation timestamp.
   *
   * @return \Drupal\contractualisation\Entity\contractualisationInterface
   *   The called Contractualisation entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Contractualisation published status indicator.
   *
   * Unpublished Contractualisation are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Contractualisation is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Contractualisation.
   *
   * @param bool $published
   *   TRUE to set this Contractualisation to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\contractualisation\Entity\contractualisationInterface
   *   The called Contractualisation entity.
   */
  public function setPublished($published);

}
