<?php

namespace Drupal\permisautorisation\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Permisautorisation entities.
 *
 * @ingroup permisautorisation
 */
interface PermisautorisationInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Permisautorisation name.
   *
   * @return string
   *   Name of the Permisautorisation.
   */
  public function getName();

  /**
   * Sets the Permisautorisation name.
   *
   * @param string $name
   *   The Permisautorisation name.
   *
   * @return \Drupal\permisautorisation\Entity\PermisautorisationInterface
   *   The called Permisautorisation entity.
   */
  public function setName($name);

  /**
   * Gets the Permisautorisation creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Permisautorisation.
   */
  public function getCreatedTime();

  /**
   * Sets the Permisautorisation creation timestamp.
   *
   * @param int $timestamp
   *   The Permisautorisation creation timestamp.
   *
   * @return \Drupal\permisautorisation\Entity\PermisautorisationInterface
   *   The called Permisautorisation entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Permisautorisation published status indicator.
   *
   * Unpublished Permisautorisation are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Permisautorisation is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Permisautorisation.
   *
   * @param bool $published
   *   TRUE to set this Permisautorisation to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\permisautorisation\Entity\PermisautorisationInterface
   *   The called Permisautorisation entity.
   */
  public function setPublished($published);

}
