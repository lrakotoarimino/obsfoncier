<?php

namespace Drupal\permisminier\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Permisminier entities.
 */
class PermisminierViewsData extends EntityViewsData {

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
