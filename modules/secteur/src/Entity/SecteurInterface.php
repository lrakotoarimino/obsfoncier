<?php

namespace Drupal\secteur\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Secteur entities.
 *
 * @ingroup secteur
 */
interface SecteurInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Secteur name.
   *
   * @return string
   *   Name of the Secteur.
   */
  public function getName();

  /**
   * Sets the Secteur name.
   *
   * @param string $name
   *   The Secteur name.
   *
   * @return \Drupal\secteur\Entity\SecteurInterface
   *   The called Secteur entity.
   */
  public function setName($name);

  /**
   * Gets the Secteur creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Secteur.
   */
  public function getCreatedTime();

  /**
   * Sets the Secteur creation timestamp.
   *
   * @param int $timestamp
   *   The Secteur creation timestamp.
   *
   * @return \Drupal\secteur\Entity\SecteurInterface
   *   The called Secteur entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Secteur published status indicator.
   *
   * Unpublished Secteur are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Secteur is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Secteur.
   *
   * @param bool $published
   *   TRUE to set this Secteur to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\secteur\Entity\SecteurInterface
   *   The called Secteur entity.
   */
  public function setPublished($published);

}
