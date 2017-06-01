<?php

/**
 * @file
 * Contains contrat.page.inc.
 *
 * Page callback for Contrat entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Contrat templates.
 *
 * Default template: contrat.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_contrat(array &$variables) {
  // Fetch Contrat Entity Object.
  $contrat = $variables['elements']['#contrat'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
