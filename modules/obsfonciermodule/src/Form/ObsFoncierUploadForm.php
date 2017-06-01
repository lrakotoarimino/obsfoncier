<?php
/**
 * @file
 * Contains \Drupal\obsfonciermodule\Form\ObsFoncierUploadForm
 */

namespace Drupal\obsfonciermodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormState;
use Drupal\Core\Entity;
use Drupal\Core\Url;

//use Drupal\apeee_co;

class ObsFoncierUploadForm extends FormBase {
	
	/**
	 * {@inheritdoc}
	 */
	public function getFormId() {
		return 'obsfoncier_upload_form';
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		
		$currentUserId = $this->currentUser()->id();
		
		
		$form['fieldset_upload'] = array(
				'#type' => 'fieldset',
				'#title' => $this->t("Importation des données"),
		);
		
		
		$form['fieldset_upload']['parent'] = array(
				'#title' => $this->t("Fichier :"),
				'#type' => 'managed_file',
				'#required' => true,
				'#upload_location' => 'public://fichiers_importes/',
				'#description'          => t('Extensions autorisées : xls xlxs'),
				'#multiple'             => FALSE,
				'#upload_validators'    => [
						'file_validate_extensions'    => array('xls xlsx'),
						'file_validate_size'          => array(25600000)
				],
		);
		
		
		$form['submit'] = array(
				'#type' => 'submit',
				'#value' => $this->t('Importer'),
		);
		return $form;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm($form, $form_state);
		
		if (!$form_state->hasAnyErrors()) {
			//$parent_id= $form['parent_demandeur']['parent']['#value'];
			//
			/*$parent_id = $form_state->getValue('parent');
			$parent_id = ac_getIdAutocoplete($parent_id, '', 'user');
			
			$parent  = \Drupal\user\Entity\User::load($parent_id);
			
			
			if (!$parent){
				$form_state->setErrorByName('casiers',
						$this->t("Ce parent est inconnu."));
			}*/
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		/*$parent_id = $form_state->getValue('parent');
		$parent_id = ac_getIdAutocoplete($parent_id, '', 'user');
		
		if (!empty($parent_id)) {
			$_SESSION['apeee_inscription_service_form']['parent_id'] = $parent_id;
			
			$url = Url::fromRoute('inscription_casier_form.form');
			return $form_state->setRedirectUrl($url);
			
		}*/
	}
	
}
