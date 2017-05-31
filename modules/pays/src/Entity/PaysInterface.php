<?php

namespace Drupal\pays\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Pays entities.
 *
 * @ingroup pays
 */
interface PaysInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Pays name.
   *
   * @return string
   *   Name of the Pays.
   */
  public function getName();

  /**
   * Sets the Pays name.
   *
   * @param string $name
   *   The Pays name.
   *
   * @return \Drupal\pays\Entity\PaysInterface
   *   The called Pays entity.
   */
  public function setName($name);

  /**
   * Gets the Pays creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Pays.
   */
  public function getCreatedTime();

  /**
   * Sets the Pays creation timestamp.
   *
   * @param int $timestamp
   *   The Pays creation timestamp.
   *
   * @return \Drupal\pays\Entity\PaysInterface
   *   The called Pays entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Pays published status indicator.
   *
   * Unpublished Pays are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Pays is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Pays.
   *
   * @param bool $published
   *   TRUE to set this Pays to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\pays\Entity\PaysInterface
   *   The called Pays entity.
   */
  public function setPublished($published);

}
