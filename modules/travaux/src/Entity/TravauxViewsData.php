<?php

namespace Drupal\travaux\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Liste des travaux entities.
 */
class TravauxViewsData extends EntityViewsData {

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
