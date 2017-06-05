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
use Drupal\file\Entity\File;
//use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
//use PHPExcel_Cell_DataType;

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
		
		
		$form['fieldset_upload']['myfile'] = array(
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
		
		//$form['#attached']['library'][] = 'obsfonciermodule/obsfonciermodule_library';
		
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
			
			//Si on veut valider avant le fichier
			$fid = $form_state->getValue('myfile');
			//le nom / emplacement du fichier est dans la table file_managed, champ uri
			$fid = current($fid);
			$errors = readFile($fid, 'valide');
			if (!empty($errors)) {
				$i=0;
				forEach($errors as $error) {
					$i++;
					$form_state->setErrorByName('Validation'.$i,$error);
				}
				$form_state->setErrorByName('Validation', "Le fichier n'a pas été importé. Veuillez corriger les erreurs");
				
			}
			
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		
		$fid = $form_state->getValue('myfile');
		//le nom / emplacement du fichier est dans la table file_managed, champ uri
		$fid = current($fid);
		$nbProjet = readFile($fid, 'insere');
		
		drupal_set_message($nbProjet . " projets ont été importés ou mis à jour");
		return false;
		
		/*$url = Url::fromRoute('inscription_casier_form.form');
			return $form_state->setRedirectUrl($url);
			
		}*/
	}
	
}

function get_data_par_defaut(){
	$data = array();
	$data['type'] = "type1";$data['uuid'] = gen_uuid();
	$data['langcode'] = "fr";$data['user_id'] = 1;
	$data['status'] = 1;$data['created'] = time();$data['changed'] = time();
	return $data;
}

function gen_uuid() {
	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			
			mt_rand( 0, 0xffff ),
			
			mt_rand( 0, 0x0fff ) | 0x4000,
			
			mt_rand( 0, 0x3fff ) | 0x8000,
			
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
			);
}

function get_reference_id($name,$reference){
	$id = 0;global $con;
	if($name){
		$sql = "select * from ".$reference." where name ='".addslashes($name)."'";
		$requete = mysqli_query($con,$sql) ;
		while ($donnees = mysqli_fetch_array($requete)) {
			$id = $donnees['id'];
		}
		if(!$id){
			$data = get_data_par_defaut();
			$data['name'] = addslashes($name);
			$sql = "INSERT INTO ".$reference."  (type, uuid, langcode, user_id, name, status, created, changed) VALUES ('".$data['type']."','".$data['uuid']."','".$data['langcode']."','".$data['user_id']."','".$data['name']."','".$data['status']."','".$data['created']."','".$data['changed']."')";
			mysqli_query($con,$sql) ;
			$id = mysql_insert_id();
		}
	}
	return $id;
}

function import_data_entreprise($data){
	
	$sql = "select * from entreprise where cd_projet ='".$data['cd_projet']."'";
	
	$id = 0;
	$entreprise = db_query($sql)->fetch();;
	$id = $entreprise->id;
	
	if(!$id) {
		$sql = "INSERT INTO entreprise (type, uuid, langcode, user_id, name, status, created, changed,adresse,cd_projet,secteur_id,phase_id,formejuridique_id,activite_id,pays_id) VALUES ('".$data['type']."','".$data['uuid']."','".$data['langcode']."','".$data['user_id']."','".$data['name']."','".$data['status']."','".$data['created']."','".$data['changed']."'
				,'".$data['adresse']."','".$data['cd_projet']."','".$data['secteur_id']."','".$data['phase_id']."','".$data['formejuridique_id']."','".$data['activite_id']."','".$data['pays_id']."')";
	} else {
			$sql = "UPDATE entreprise SET name = '".$data['name']."', adresse = '".$data['adresse']."',cd_projet = '".$data['cd_projet']."',
						secteur_id = '".$data['secteur_id']."',phase_id = '".$data['phase_id']."',formejuridique_id = '".$data['formejuridique_id']."'
						,activite_id = '".$data['activite_id']."',pays_id = '".$data['pays_id']."'
					  WHERE id = ".$id;
	}
	
	db_query($sql);
}

function readFile($fid, $mode) {
	$file = File::load($fid);
	$uri = $file->getFileUri();
	$message = "";
	
	
	if ($mode == 'valide') {
		//On ne fait qu'une fois
		include 'libraries/PHPExcel/IOFactory.php';
	}
	
	
	$path = drupal_realpath($uri);
	
	try {
		$inputFileType = PHPExcel_IOFactory::identify($path);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($path);
	} catch (Exception $e) {
		
	}
	$nbProjet = 0;
	$error = array();
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
		$onglet    = $worksheet->getTitle();
		
		$highestRow         = $worksheet->getHighestRow();
		$highestColumn      = $worksheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		
		for ($row = 2; $row <= $highestRow; ++ $row){
			$data = get_data_par_defaut();
			$message .= "Traitement de la ligne ".$row."\n";
			$errorLigne = "Traitement de la ligne ".$row."\n";
			$errorCell = "";
			
			for ($col = 0; $col < $highestColumnIndex; ++ $col){
				$cell = $worksheet->getCellByColumnAndRow($col, $row);
				$val = $cell->getValue();
				
				if($col == 0 && !$val) {
					//Le code projet n'est pas présent dans Excel, la ligne ne sera pas importée
					if ($onglet == "PROJET"){
						$errorCell.="Code projet vide";
					}
					break;
				}
				
				if ($onglet == "PROJET"){
					if($col == 0) {
						if (!empty($val)) {
							$data['cd_projet'] = $val;
						} else {
							//$message .= "Ligne ".$row." - Code projet vide\n";
						}
						
					}
					else if($col == 1) {
						if (!empty($val)) {
							$data['name'] = $val;
						} else {
							$errorCell.= "Nom entreprise vide";
						}
						
				}
				else if($col == 2) $data['adresse'] = $val;
				else if($col == 3) $data['formejuridique_id'] = get_reference_id($val,'formejuridique');
				else if($col == 4) $data['pays_id'] = get_reference_id($val,'pays');
				else if($col == 5) $data['activite_id'] = get_reference_id($val,'activite');
				else if($col == 6) $data['secteur_id'] = get_reference_id($val,'secteur');
				else if($col == 9){
					$data['phase_id'] = get_reference_id($val,'phase');
					if ($mode == 'insere') {
						import_data_entreprise($data);
						$nbProjet++;
					}
					
				}
				}
				else if ($onglet == "TABLE_FORME_JURIDIQUE"){
					if($col == 1)get_reference_id($val,'formejuridique');
				}
				else if ($onglet == "TABLE_PHASE"){
					if($col == 1)get_reference_id($val,'phase');
				}
				else if ($onglet == "TABLE_SECTEUR"){
					if($col == 1)get_reference_id($val,'secteur');
				}
				else if ($onglet == "TABLE_ACTIVITE"){
					if($col == 1)get_reference_id($val,'activite');
				}
				else if ($onglet == "TABLE_PAYS"){
					if($col == 1)get_reference_id($val,'pays');
				}
			}
			if (!empty($errorCell)) {
				$error[] = $errorLigne." - ".$errorCell;
			}
		}
		
		
	}
	$objPHPExcel->disconnectWorksheets();
	unset($objPHPExcel);
	
	if ($mode == 'valide') {
		return $error;
	} else {
		return $nbProjet;
	}
	
	
	
	
	
}
