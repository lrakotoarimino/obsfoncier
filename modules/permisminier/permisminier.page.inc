<?php

/**
 * @file
 * Contains permisminier.page.inc.
 *
 * Page callback for Permisminier entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Permisminier templates.
 *
 * Default template: permisminier.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_permisminier(array &$variables) {
  // Fetch Permisminier Entity Object.
  $permisminier = $variables['elements']['#permisminier'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
