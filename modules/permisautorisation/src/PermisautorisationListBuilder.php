<?php

namespace Drupal\permisautorisation;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Permisautorisation entities.
 *
 * @ingroup permisautorisation
 */
class PermisautorisationListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Permisautorisation ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\permisautorisation\Entity\Permisautorisation */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.permisautorisation.edit_form', [
          'permisautorisation' => $entity->id(),
        ]
      )
    );
    return $row + parent::buildRow($entity);
  }

}
