<?php

namespace Drupal\motifavenant;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Motifavenant entity.
 *
 * @see \Drupal\motifavenant\Entity\Motifavenant.
 */
class MotifavenantAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\motifavenant\Entity\MotifavenantInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished motifavenant entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published motifavenant entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit motifavenant entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete motifavenant entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add motifavenant entities');
  }

}
