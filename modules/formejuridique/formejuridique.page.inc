<?php

/**
 * @file
 * Contains formejuridique.page.inc.
 *
 * Page callback for Formejuridique entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Formejuridique templates.
 *
 * Default template: formejuridique.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_formejuridique(array &$variables) {
  // Fetch Formejuridique Entity Object.
  $formejuridique = $variables['elements']['#formejuridique'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
