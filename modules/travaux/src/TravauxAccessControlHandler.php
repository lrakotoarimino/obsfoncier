<?php

namespace Drupal\travaux;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Liste des travaux entity.
 *
 * @see \Drupal\travaux\Entity\Travaux.
 */
class TravauxAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\travaux\Entity\TravauxInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished liste des travaux entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published liste des travaux entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit liste des travaux entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete liste des travaux entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add liste des travaux entities');
  }

}
