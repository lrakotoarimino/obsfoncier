<?php

namespace Drupal\secteur;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Secteur entity.
 *
 * @see \Drupal\secteur\Entity\Secteur.
 */
class SecteurAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\secteur\Entity\SecteurInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished secteur entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published secteur entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit secteur entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete secteur entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add secteur entities');
  }

}
