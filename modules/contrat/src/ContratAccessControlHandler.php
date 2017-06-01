<?php

namespace Drupal\contrat;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Contrat entity.
 *
 * @see \Drupal\contrat\Entity\Contrat.
 */
class ContratAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\contrat\Entity\ContratInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished contrat entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published contrat entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit contrat entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete contrat entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add contrat entities');
  }

}
