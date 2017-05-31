<?php

/*
 * @file
 * Contains \Drupal\entreprise\Plugin\Block\VwPermisminier
 */

namespace Drupal\entreprise\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;

/**
 * @Block (
 *  id = "VwPermisminier",
 *  admin_label = @Translation("VwPermisminier"),
 *  categroy = @Translation("ObsFoncier")
 * )
 */
class VwPermisminier extends BlockBase {
	
	/**
	 * {@inheritdoc}
	 */
	public function build() {
		// check si le user est un ministere
		if (!in_array('ministere', \Drupal::currentUser()->getRoles())) {
			return ['#markup' => '<hr />'];
		}
		
		$vw = views_embed_view('liste_des_permis_miniers', 'block_1', ac_getParentPrincipalCurrentUser());
		$renderview = \Drupal::service('renderer')->render($vw);
		
		$link = '<div class="BtnCommander">'
				. Link::createFromRoute($this->t('Ajouter un permis minier'), 'adulte_form.form', array('identity' => 'add'), array('attributes' => array('class' => array('btn', 'btn-default'))))->toString()
				. '</div>';
				
				return [
						'#markup' => $renderview . $link . '<hr />'
				];
	}
	
}
