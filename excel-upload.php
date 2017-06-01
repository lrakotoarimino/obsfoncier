<?php

include 'libraries/PHPExcel/IOFactory.php';
die("ok1");
$server = "localhost";
$username = "root";
$password = "root";
$database = "obs_foncier";

mysql_connect($server, $username, $password);
mysql_select_db($database);

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
	$id = 0;
	if($name){
		$sql = "select * from ".$reference." where name ='".addslashes($name)."'";
		$requete = mysql_query($sql) ;
		while ($donnees = mysql_fetch_array($requete)) {
			$id = $donnees['id'];
		}
		if(!$id){
			$data = get_data_par_defaut();
			$data['name'] = addslashes($name);
			$sql = "INSERT INTO ".$reference."  (type, uuid, langcode, user_id, name, status, created, changed) VALUES ('".$data['type']."','".$data['uuid']."','".$data['langcode']."','".$data['user_id']."','".$data['name']."','".$data['status']."','".$data['created']."','".$data['changed']."')";
			mysql_query($sql) ;
			$id = mysql_insert_id();
		}
	}
	return $id;
}

function import_data_entreprise($data){
	$sql = "select * from entreprise where cd_projet ='".$data['cd_projet']."'";
	$requete = mysql_query($sql) ;$id = 0;
	while ($donnees = mysql_fetch_array($requete)) {
		$id = $donnees['id'];
	}
	if(!$id)
		$sql = "INSERT INTO entreprise (type, uuid, langcode, user_id, name, status, created, changed,adresse,cd_projet,secteur_id,phase_id,formejuridique_id,activite_id,pays_id) VALUES ('".$data['type']."','".$data['uuid']."','".$data['langcode']."','".$data['user_id']."','".$data['name']."','".$data['status']."','".$data['created']."','".$data['changed']."'
										,'".$data['adresse']."','".$data['cd_projet']."','".$data['secteur_id']."','".$data['phase_id']."','".$data['formejuridique_id']."','".$data['activite_id']."','".$data['pays_id']."')";
	else 
		$sql = "UPDATE entreprise SET name = '".$data['name']."', adresse = '".$data['adresse']."',cd_projet = '".$data['cd_projet']."',
										secteur_id = '".$data['secteur_id']."',phase_id = '".$data['phase_id']."',formejuridique_id = '".$data['formejuridique_id']."'
										,activite_id = '".$data['activite_id']."',pays_id = '".$data['pays_id']."'
								  WHERE id = ".$id;
	mysql_query($sql) ;
}


if(isset($_FILES['file']['name'])){
	
	$file_name = $_FILES['file']['name'];
	$path= $_FILES['file']['tmp_name'];
	try {
		$inputFileType = PHPExcel_IOFactory::identify($path);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($path);
	} catch (Exception $e) {
		
	}
	$nbProjet = 0;
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
		$onglet    = $worksheet->getTitle();
		$highestRow         = $worksheet->getHighestRow();
		$highestColumn      = $worksheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		for ($row = 2; $row <= $highestRow; ++ $row){
			$data = get_data_par_defaut();
			for ($col = 0; $col < $highestColumnIndex; ++ $col){
				$cell = $worksheet->getCellByColumnAndRow($col, $row);
				$val = $cell->getValue();
				if($col == 0 && !$val)break;
				if ($onglet == "PROJET"){
					if($col == 0)$data['cd_projet'] = $val;
					else if($col == 1)$data['name'] = $val;
					else if($col == 2)$data['adresse'] = $val;
					else if($col == 3)$data['formejuridique_id'] = get_reference_id($val,'formejuridique');
					else if($col == 4)$data['pays_id'] = get_reference_id($val,'pays');
					else if($col == 5)$data['activite_id'] = get_reference_id($val,'activite');
					else if($col == 6)$data['secteur_id'] = get_reference_id($val,'secteur');
					else if($col == 9){
						$data['phase_id'] = get_reference_id($val,'phase');
						import_data_entreprise($data);$nbProjet++;
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
		}
	}
	
	$objPHPExcel->disconnectWorksheets();
	unset($objPHPExcel);
	echo $nbProjet . " de projets importés";
}
?>
