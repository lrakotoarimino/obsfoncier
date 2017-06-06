<?php

/**
 * @file
 * Contains travaux.page.inc.
 *
 * Page callback for Liste des travaux entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Liste des travaux templates.
 *
 * Default template: travaux.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_travaux(array &$variables) {
  // Fetch Travaux Entity Object.
  $travaux = $variables['elements']['#travaux'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
