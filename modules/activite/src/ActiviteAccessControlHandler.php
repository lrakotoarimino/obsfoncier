<?php

namespace Drupal\activite;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Activite entity.
 *
 * @see \Drupal\activite\Entity\Activite.
 */
class ActiviteAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\activite\Entity\ActiviteInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished activite entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published activite entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit activite entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete activite entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add activite entities');
  }

}
