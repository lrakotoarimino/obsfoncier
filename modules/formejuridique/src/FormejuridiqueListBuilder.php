<?php

namespace Drupal\formejuridique;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Formejuridique entities.
 *
 * @ingroup formejuridique
 */
class FormejuridiqueListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Formejuridique ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\formejuridique\Entity\Formejuridique */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.formejuridique.edit_form', [
          'formejuridique' => $entity->id(),
        ]
      )
    );
    return $row + parent::buildRow($entity);
  }

}
