<?php
// $_POST['formToCompute'] = 'fruits';
// $_POST['formToCompute'] = json_encode($_POST['formToCompute']);
// $_POST['weekChoose'] = 'semaine_1';
// $_POST['weekChoose'] = json_encode($_POST['weekChoose']);
// $_POST['formToCompute'] = 'formEmail';
// $_POST['formToCompute'] =json_encode($_POST['formToCompute']);
// $_POST['userFirstName']	= 'yayaTest';
// $_POST['userFirstName'] = json_encode($_POST['userFirstName']);
// $_POST['userName'] = 'khekheTest';
// $_POST['userName'] = json_encode($_POST['userName']);
$townList = array('Besançon', 'Dole', 'Chalon', 'Paris', 'Vesoul', 'Pontarlier');


function decodeAndSecure($tableau){
	$valeurs = [];
	foreach ($tableau as $key => $value) {
		// var_dump($value);
		$value = htmlspecialchars(json_decode($value));
		// var_dump($value);
		$valeurs[$key] = $value;
		// var_dump($valeurs);
	}
	return $valeurs;
}
function formFruits($tableau){
	$fruitsLists = array('semaine_1' => array('Banane', 'Fraise', 'Orange'), 'semaine_2' => array('Cerise', 'Prune'), 'semaine_3' => array('Raisin', 'Pruneau', 'Kiwi'));
	if ((isset($tableau['weekChoose'])) && (!empty($tableau['weekChoose']))){
	$userSelection = $tableau['weekChoose'];
		// echo 'coucou';
		if (array_key_exists($userSelection, $fruitsLists)){
			$serverRep = array('error' => false, $fruitsLists[$userSelection]);
			// echo 'test';
		} else {
			$serverRep = array('error' => true, array('Veuillez sélectionner correctement une semaine'));
		}
		echo json_encode($serverRep);
		// var_dump($serverRep);
	}
}
function formEmail($tableau){
	if ((isset($tableau['userName'])) && (isset($tableau['userFirstName']))){
		if ((!empty($tableau['userName'])) || (!empty($tableau['userFirstName']))){
			if ((is_string($tableau['userName'])) && (is_string($tableau['userFirstName']))){
			
				$userName = $tableau['userName'];
				$userFirstName = $tableau['userFirstName'];
				$mailDest = "yannick.k@codeur.online";
				$mailSubject = "Nouvel adhérent";
				$mailMessage = "Nom : $userName" . "\r\n" . "Prénom : " . $userFirstName . "\r\n";
				$header = "From: webmaster@example.com" . "\r\n";
				$header .= "Content-type: text/html; charset=utf-8" . "\r\n";
				mail($mailDest, $mailSubject, $mailMessage, $header);
				$serverRep = array('error' => false, array('Email Envoyé'));
			}
		} else {
			$serverRep = array('error' => true, array('Erreur veuillez remplir les champs nom et prénom'));
		}
		echo json_encode($serverRep);			
	}
}
function formTown($tableau){
	$townList = array('Besançon', 'Dole', 'Chalon', 'Paris', 'Vesoul', 'Pontarlier');
	if (isset($tableau['town'])){
		if (!empty($tableau['town'])){
			if (is_string($tableau['town'])){
				if (in_array($tableau['town'], $townList)){
					$serverRep = array('error' => false, array('La ville demandée existe'));
				} else {
					$serverRep = array('error' => false, array('La ville demandée n\'existe pas'));
				}
			} else {
				$serverRep = array('error' => true, array('Veuillez remplir correctement le champs ville'));
			}
		} else {
			$serverRep = array('error' => true, array('Veuillez remplir correctement le champs ville'));
		}
		echo json_encode($serverRep);
	}
}

// Oriente selon les différents formulaires
if (isset($_POST['formToCompute'])){
	$_POST['formToCompute'] = json_decode($_POST['formToCompute']);
	if (!empty($_POST['formToCompute'])){
		if ($_POST['formToCompute'] == "fruits"){
			$data = decodeAndSecure(array('weekChoose' => $_POST['weekChoose']));
			formFruits($data);
			// var_dump($data);
		}
		if ($_POST['formToCompute'] == "formEmail"){
			$data = decodeAndSecure(array('userName' => $_POST['userName'], 
										  'userFirstName' => $_POST['userFirstName']));
			formEmail($data);
		}
		if ($_POST['formToCompute'] == "townForm"){
			$data = decodeAndSecure(array('town' => $_POST['town']));
			formTown($data);
		}
	}
}