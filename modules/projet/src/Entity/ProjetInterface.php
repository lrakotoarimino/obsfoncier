<?php

namespace Drupal\projet\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Projet entities.
 *
 * @ingroup projet
 */
interface ProjetInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Projet name.
   *
   * @return string
   *   Name of the Projet.
   */
  public function getName();

  /**
   * Sets the Projet name.
   *
   * @param string $name
   *   The Projet name.
   *
   * @return \Drupal\projet\Entity\ProjetInterface
   *   The called Projet entity.
   */
  public function setName($name);

  /**
   * Gets the Projet creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Projet.
   */
  public function getCreatedTime();

  /**
   * Sets the Projet creation timestamp.
   *
   * @param int $timestamp
   *   The Projet creation timestamp.
   *
   * @return \Drupal\projet\Entity\ProjetInterface
   *   The called Projet entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Projet published status indicator.
   *
   * Unpublished Projet are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Projet is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Projet.
   *
   * @param bool $published
   *   TRUE to set this Projet to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\projet\Entity\ProjetInterface
   *   The called Projet entity.
   */
  public function setPublished($published);

}
