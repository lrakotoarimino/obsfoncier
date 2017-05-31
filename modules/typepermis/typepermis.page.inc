<?php

/**
 * @file
 * Contains typepermis.page.inc.
 *
 * Page callback for Typepermis entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Typepermis templates.
 *
 * Default template: typepermis.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_typepermis(array &$variables) {
  // Fetch Typepermis Entity Object.
  $typepermis = $variables['elements']['#typepermis'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
