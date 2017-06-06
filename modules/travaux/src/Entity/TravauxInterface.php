<?php

namespace Drupal\travaux\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Liste des travaux entities.
 *
 * @ingroup travaux
 */
interface TravauxInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Liste des travaux name.
   *
   * @return string
   *   Name of the Liste des travaux.
   */
  public function getName();

  /**
   * Sets the Liste des travaux name.
   *
   * @param string $name
   *   The Liste des travaux name.
   *
   * @return \Drupal\travaux\Entity\TravauxInterface
   *   The called Liste des travaux entity.
   */
  public function setName($name);

  /**
   * Gets the Liste des travaux creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Liste des travaux.
   */
  public function getCreatedTime();

  /**
   * Sets the Liste des travaux creation timestamp.
   *
   * @param int $timestamp
   *   The Liste des travaux creation timestamp.
   *
   * @return \Drupal\travaux\Entity\TravauxInterface
   *   The called Liste des travaux entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Liste des travaux published status indicator.
   *
   * Unpublished Liste des travaux are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Liste des travaux is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Liste des travaux.
   *
   * @param bool $published
   *   TRUE to set this Liste des travaux to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\travaux\Entity\TravauxInterface
   *   The called Liste des travaux entity.
   */
  public function setPublished($published);

}
