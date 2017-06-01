<?php

/**
 * @file
 * Contains permisautorisation.page.inc.
 *
 * Page callback for Permisautorisation entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Permisautorisation templates.
 *
 * Default template: permisautorisation.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_permisautorisation(array &$variables) {
  // Fetch Permisautorisation Entity Object.
  $permisautorisation = $variables['elements']['#permisautorisation'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
