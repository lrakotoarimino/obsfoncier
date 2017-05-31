<?php

namespace Drupal\pays;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Pays entity.
 *
 * @see \Drupal\pays\Entity\Pays.
 */
class PaysAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\pays\Entity\PaysInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished pays entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published pays entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit pays entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete pays entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add pays entities');
  }

}
