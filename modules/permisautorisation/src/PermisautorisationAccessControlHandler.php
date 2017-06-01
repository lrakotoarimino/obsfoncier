<?php

namespace Drupal\permisautorisation;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Permisautorisation entity.
 *
 * @see \Drupal\permisautorisation\Entity\Permisautorisation.
 */
class PermisautorisationAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\permisautorisation\Entity\PermisautorisationInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished permisautorisation entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published permisautorisation entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit permisautorisation entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete permisautorisation entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add permisautorisation entities');
  }

}
