<?php

namespace Drupal\typepermis\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Typepermis entities.
 *
 * @ingroup typepermis
 */
interface TypepermisInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Typepermis name.
   *
   * @return string
   *   Name of the Typepermis.
   */
  public function getName();

  /**
   * Sets the Typepermis name.
   *
   * @param string $name
   *   The Typepermis name.
   *
   * @return \Drupal\typepermis\Entity\TypepermisInterface
   *   The called Typepermis entity.
   */
  public function setName($name);

  /**
   * Gets the Typepermis creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Typepermis.
   */
  public function getCreatedTime();

  /**
   * Sets the Typepermis creation timestamp.
   *
   * @param int $timestamp
   *   The Typepermis creation timestamp.
   *
   * @return \Drupal\typepermis\Entity\TypepermisInterface
   *   The called Typepermis entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Typepermis published status indicator.
   *
   * Unpublished Typepermis are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Typepermis is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Typepermis.
   *
   * @param bool $published
   *   TRUE to set this Typepermis to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\typepermis\Entity\TypepermisInterface
   *   The called Typepermis entity.
   */
  public function setPublished($published);

}
