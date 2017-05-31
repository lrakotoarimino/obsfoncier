<?php

/**
 * @file
 * Contains motifavenant.page.inc.
 *
 * Page callback for Motifavenant entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Motifavenant templates.
 *
 * Default template: motifavenant.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_motifavenant(array &$variables) {
  // Fetch Motifavenant Entity Object.
  $motifavenant = $variables['elements']['#motifavenant'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
