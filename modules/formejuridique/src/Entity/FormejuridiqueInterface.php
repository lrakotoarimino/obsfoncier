<?php

namespace Drupal\formejuridique\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Formejuridique entities.
 *
 * @ingroup formejuridique
 */
interface FormejuridiqueInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Formejuridique name.
   *
   * @return string
   *   Name of the Formejuridique.
   */
  public function getName();

  /**
   * Sets the Formejuridique name.
   *
   * @param string $name
   *   The Formejuridique name.
   *
   * @return \Drupal\formejuridique\Entity\FormejuridiqueInterface
   *   The called Formejuridique entity.
   */
  public function setName($name);

  /**
   * Gets the Formejuridique creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Formejuridique.
   */
  public function getCreatedTime();

  /**
   * Sets the Formejuridique creation timestamp.
   *
   * @param int $timestamp
   *   The Formejuridique creation timestamp.
   *
   * @return \Drupal\formejuridique\Entity\FormejuridiqueInterface
   *   The called Formejuridique entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Formejuridique published status indicator.
   *
   * Unpublished Formejuridique are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Formejuridique is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Formejuridique.
   *
   * @param bool $published
   *   TRUE to set this Formejuridique to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\formejuridique\Entity\FormejuridiqueInterface
   *   The called Formejuridique entity.
   */
  public function setPublished($published);

}
