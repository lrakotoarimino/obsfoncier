<?php

namespace Drupal\typepermis;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Typepermis entity.
 *
 * @see \Drupal\typepermis\Entity\Typepermis.
 */
class TypepermisAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\typepermis\Entity\TypepermisInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished typepermis entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published typepermis entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit typepermis entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete typepermis entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add typepermis entities');
  }

}
