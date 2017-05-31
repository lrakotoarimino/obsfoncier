<?php

namespace Drupal\secteur\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Secteur entities.
 */
class SecteurViewsData extends EntityViewsData {

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
