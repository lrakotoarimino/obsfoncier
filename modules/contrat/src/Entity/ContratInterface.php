<?php

namespace Drupal\contrat\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Contrat entities.
 *
 * @ingroup contrat
 */
interface ContratInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Contrat name.
   *
   * @return string
   *   Name of the Contrat.
   */
  public function getName();

  /**
   * Sets the Contrat name.
   *
   * @param string $name
   *   The Contrat name.
   *
   * @return \Drupal\contrat\Entity\ContratInterface
   *   The called Contrat entity.
   */
  public function setName($name);

  /**
   * Gets the Contrat creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Contrat.
   */
  public function getCreatedTime();

  /**
   * Sets the Contrat creation timestamp.
   *
   * @param int $timestamp
   *   The Contrat creation timestamp.
   *
   * @return \Drupal\contrat\Entity\ContratInterface
   *   The called Contrat entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Contrat published status indicator.
   *
   * Unpublished Contrat are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Contrat is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Contrat.
   *
   * @param bool $published
   *   TRUE to set this Contrat to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\contrat\Entity\ContratInterface
   *   The called Contrat entity.
   */
  public function setPublished($published);

}
