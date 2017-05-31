<?php

namespace Drupal\permisminier\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Permisminier entities.
 *
 * @ingroup permisminier
 */
interface PermisminierInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Permisminier name.
   *
   * @return string
   *   Name of the Permisminier.
   */
  public function getName();

  /**
   * Sets the Permisminier name.
   *
   * @param string $name
   *   The Permisminier name.
   *
   * @return \Drupal\permisminier\Entity\PermisminierInterface
   *   The called Permisminier entity.
   */
  public function setName($name);

  /**
   * Gets the Permisminier creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Permisminier.
   */
  public function getCreatedTime();

  /**
   * Sets the Permisminier creation timestamp.
   *
   * @param int $timestamp
   *   The Permisminier creation timestamp.
   *
   * @return \Drupal\permisminier\Entity\PermisminierInterface
   *   The called Permisminier entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Permisminier published status indicator.
   *
   * Unpublished Permisminier are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Permisminier is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Permisminier.
   *
   * @param bool $published
   *   TRUE to set this Permisminier to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\permisminier\Entity\PermisminierInterface
   *   The called Permisminier entity.
   */
  public function setPublished($published);

}
