<?php

/**
 * @file
 * Contains phase.page.inc.
 *
 * Page callback for Phase entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Phase templates.
 *
 * Default template: phase.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_phase(array &$variables) {
  // Fetch Phase Entity Object.
  $phase = $variables['elements']['#phase'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
