<?php
/*
 * @file
 * Contains \Drupal\entreprise\Plugin\Block\VwPermisautorisation
 */
namespace Drupal\entreprise\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
/**
 * @Block (
 *  id = "VwPermisautorisation",
 *  admin_label = @Translation("VwPermisautorisation"),
 *  category = @Translation("entreprise")
 * )
 */
class VwPermisautorisation extends BlockBase {
	
	/**
	 * {@inheritdoc}
	 */
	public function build() {
		// check si le user est un ministere
		if (!in_array('ministere', \Drupal::currentUser()->getRoles())
				&& !in_array('adminfoncier', \Drupal::currentUser()->getRoles()) ) {
					return ['#markup' => '<hr />'];
				}
				
		$path = \Drupal::request()->getpathInfo();
		$arg  = explode('/',$path);
		
		if (isset($arg[5]) && $arg[5] != 'edit') {
			$idEntreprise= intVal($arg[3]);
		} elseif (isset($arg[4]) && $arg[4] != 'edit') {
			$idEntreprise= intVal($arg[4]);
		}
		
		$vw = views_embed_view('liste_des_permis_autorisation', 'block_1',$idEntreprise);
		$renderview = \Drupal::service('renderer')->render($vw);
		
		
				
		return [
				'#markup' => $renderview .  '<hr />'
		];
	}
	
}