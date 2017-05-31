<?php

namespace Drupal\entreprise\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Entreprise entities.
 *
 * @ingroup entreprise
 */
interface EntrepriseInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Entreprise name.
   *
   * @return string
   *   Name of the Entreprise.
   */
  public function getName();

  /**
   * Sets the Entreprise name.
   *
   * @param string $name
   *   The Entreprise name.
   *
   * @return \Drupal\entreprise\Entity\EntrepriseInterface
   *   The called Entreprise entity.
   */
  public function setName($name);

  /**
   * Gets the Entreprise creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Entreprise.
   */
  public function getCreatedTime();

  /**
   * Sets the Entreprise creation timestamp.
   *
   * @param int $timestamp
   *   The Entreprise creation timestamp.
   *
   * @return \Drupal\entreprise\Entity\EntrepriseInterface
   *   The called Entreprise entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Entreprise published status indicator.
   *
   * Unpublished Entreprise are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Entreprise is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Entreprise.
   *
   * @param bool $published
   *   TRUE to set this Entreprise to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\entreprise\Entity\EntrepriseInterface
   *   The called Entreprise entity.
   */
  public function setPublished($published);

}
