<?php

/**
 * @file
 * Contains pays.page.inc.
 *
 * Page callback for Pays entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Pays templates.
 *
 * Default template: pays.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_pays(array &$variables) {
  // Fetch Pays Entity Object.
  $pays = $variables['elements']['#pays'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
