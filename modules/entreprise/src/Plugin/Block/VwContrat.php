<?php

/*
 * @file
 * Contains \Drupal\entreprise\Plugin\Block\VwContrat
 */

namespace Drupal\entreprise\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;

/**
 * @Block (
 *  id = "VwPermisminier",
 *  admin_label = @Translation("VwContrat"),
 *  categroy = @Translation("ObsFoncier")
 * )
 */
class VwContrat extends BlockBase {
	
	/**
	 * {@inheritdoc}
	 */
	public function build() {
		// check si le user est un ministere
		if (!in_array('ministere', \Drupal::currentUser()->getRoles())
				&& !in_array('adminfoncier', \Drupal::currentUser()->getRoles()) ) {
					return ['#markup' => '<hr />'];
				}
				
				$vw = views_embed_view('liste_des_contrats', 'block_1', ac_getParentPrincipalCurrentUser());
				$renderview = \Drupal::service('renderer')->render($vw);
				
				$link = '<div class="BtnCommander">'
						. Link::createFromRoute($this->t('Ajouter un contrat'), 'adulte_form.form', array('identity' => 'add'), array('attributes' => array('class' => array('btn', 'btn-default'))))->toString()
						. '</div>';
						
						return [
								'#markup' => $renderview . $link . '<hr />'
						];
	}
	
}
