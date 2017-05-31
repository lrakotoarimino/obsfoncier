<?php

namespace Drupal\activite\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Activite entities.
 */
class ActiviteViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
