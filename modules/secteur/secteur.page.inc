<?php

/**
 * @file
 * Contains secteur.page.inc.
 *
 * Page callback for Secteur entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Secteur templates.
 *
 * Default template: secteur.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_secteur(array &$variables) {
  // Fetch Secteur Entity Object.
  $secteur = $variables['elements']['#secteur'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
