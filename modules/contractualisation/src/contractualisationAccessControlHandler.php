<?php

namespace Drupal\contractualisation;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Contractualisation entity.
 *
 * @see \Drupal\contractualisation\Entity\contractualisation.
 */
class contractualisationAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\contractualisation\Entity\contractualisationInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished contractualisation entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published contractualisation entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit contractualisation entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete contractualisation entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add contractualisation entities');
  }

}
