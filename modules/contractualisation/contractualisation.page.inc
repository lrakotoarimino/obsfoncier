<?php

/**
 * @file
 * Contains contractualisation.page.inc.
 *
 * Page callback for Contractualisation entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Contractualisation templates.
 *
 * Default template: contractualisation.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_contractualisation(array &$variables) {
  // Fetch contractualisation Entity Object.
  $contractualisation = $variables['elements']['#contractualisation'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
