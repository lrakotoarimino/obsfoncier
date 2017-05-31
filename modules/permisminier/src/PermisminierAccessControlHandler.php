<?php

namespace Drupal\permisminier;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Permisminier entity.
 *
 * @see \Drupal\permisminier\Entity\Permisminier.
 */
class PermisminierAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\permisminier\Entity\PermisminierInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished permisminier entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published permisminier entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit permisminier entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete permisminier entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add permisminier entities');
  }

}
