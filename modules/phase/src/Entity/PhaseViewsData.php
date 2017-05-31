<?php

namespace Drupal\phase\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Phase entities.
 */
class PhaseViewsData extends EntityViewsData {

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
