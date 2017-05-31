<?php

namespace Drupal\activite\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Activite entities.
 *
 * @ingroup activite
 */
interface ActiviteInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Activite name.
   *
   * @return string
   *   Name of the Activite.
   */
  public function getName();

  /**
   * Sets the Activite name.
   *
   * @param string $name
   *   The Activite name.
   *
   * @return \Drupal\activite\Entity\ActiviteInterface
   *   The called Activite entity.
   */
  public function setName($name);

  /**
   * Gets the Activite creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Activite.
   */
  public function getCreatedTime();

  /**
   * Sets the Activite creation timestamp.
   *
   * @param int $timestamp
   *   The Activite creation timestamp.
   *
   * @return \Drupal\activite\Entity\ActiviteInterface
   *   The called Activite entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Activite published status indicator.
   *
   * Unpublished Activite are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Activite is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Activite.
   *
   * @param bool $published
   *   TRUE to set this Activite to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\activite\Entity\ActiviteInterface
   *   The called Activite entity.
   */
  public function setPublished($published);

}
