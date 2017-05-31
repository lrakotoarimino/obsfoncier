<?php

/**
 * @file
 * Contains projet.page.inc.
 *
 * Page callback for Projet entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Projet templates.
 *
 * Default template: projet.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_projet(array &$variables) {
  // Fetch Projet Entity Object.
  $projet = $variables['elements']['#projet'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
