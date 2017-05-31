<?php

namespace Drupal\phase\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Phase entities.
 *
 * @ingroup phase
 */
interface PhaseInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Phase name.
   *
   * @return string
   *   Name of the Phase.
   */
  public function getName();

  /**
   * Sets the Phase name.
   *
   * @param string $name
   *   The Phase name.
   *
   * @return \Drupal\phase\Entity\PhaseInterface
   *   The called Phase entity.
   */
  public function setName($name);

  /**
   * Gets the Phase creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Phase.
   */
  public function getCreatedTime();

  /**
   * Sets the Phase creation timestamp.
   *
   * @param int $timestamp
   *   The Phase creation timestamp.
   *
   * @return \Drupal\phase\Entity\PhaseInterface
   *   The called Phase entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Phase published status indicator.
   *
   * Unpublished Phase are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Phase is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Phase.
   *
   * @param bool $published
   *   TRUE to set this Phase to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\phase\Entity\PhaseInterface
   *   The called Phase entity.
   */
  public function setPublished($published);

}
