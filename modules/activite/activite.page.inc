<?php

/**
 * @file
 * Contains activite.page.inc.
 *
 * Page callback for Activite entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Activite templates.
 *
 * Default template: activite.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_activite(array &$variables) {
  // Fetch Activite Entity Object.
  $activite = $variables['elements']['#activite'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
