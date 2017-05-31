<?php

namespace Drupal\projet;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Projet entity.
 *
 * @see \Drupal\projet\Entity\Projet.
 */
class ProjetAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\projet\Entity\ProjetInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished projet entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published projet entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit projet entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete projet entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add projet entities');
  }

}
