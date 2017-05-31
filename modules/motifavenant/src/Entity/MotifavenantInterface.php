<?php

namespace Drupal\motifavenant\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Motifavenant entities.
 *
 * @ingroup motifavenant
 */
interface MotifavenantInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Motifavenant name.
   *
   * @return string
   *   Name of the Motifavenant.
   */
  public function getName();

  /**
   * Sets the Motifavenant name.
   *
   * @param string $name
   *   The Motifavenant name.
   *
   * @return \Drupal\motifavenant\Entity\MotifavenantInterface
   *   The called Motifavenant entity.
   */
  public function setName($name);

  /**
   * Gets the Motifavenant creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Motifavenant.
   */
  public function getCreatedTime();

  /**
   * Sets the Motifavenant creation timestamp.
   *
   * @param int $timestamp
   *   The Motifavenant creation timestamp.
   *
   * @return \Drupal\motifavenant\Entity\MotifavenantInterface
   *   The called Motifavenant entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Motifavenant published status indicator.
   *
   * Unpublished Motifavenant are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Motifavenant is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Motifavenant.
   *
   * @param bool $published
   *   TRUE to set this Motifavenant to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\motifavenant\Entity\MotifavenantInterface
   *   The called Motifavenant entity.
   */
  public function setPublished($published);

}
