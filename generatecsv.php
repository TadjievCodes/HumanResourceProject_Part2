<?php
/* Author:
	   Purpose: Generate a test data csv file with 400 employees
	   Date: Feb 2021
*/
// Init session
session_start();
// Check if the user is logged in, otherwise redirect them to the login page
if(!isset($_SESSION["username"])){
	header("Location: login.php");
	exit(); 
}
	$firstNameArr = array();
	$lastNameArr = array();
	// function to generate random first and last names

	function randomLastName() {
		$lastname = array(
			'Mischke',
			'Serna',
			'Pingree',
			'Mcnaught',
			'Pepper',
			'Schildgen',
			'Mongold',
			'Wrona',
			'Geddes',
			'Lanz',
			'Fetzer',
			'Schroeder',
			'Block',
			'Mayoral',
			'Fleishman',
			'Roberie',
			'Latson',
			'Lupo',
			'Motsinger',
			'Drews',
			'Coby',
			'Redner',
			'Culton',
			'Howe',
			'Stoval',
			'Michaud',
			'Mote',
			'Menjivar',
			'Wiers',
			'Paris',
			'Grisby',
			'Noren',
			'Damron',
			'Kazmierczak',
			'Haslett',
			'Guillemette',
			'Buresh',
			'Center',
			'Kucera',
			'Catt',
			'Badon',
			'Grumbles',
			'Antes',
			'Byron',
			'Volkman',
			'Klemp',
			'Pekar',
			'Pecora',
			'Schewe',
			'Ramage',
		);
	
		$name = $lastname[rand ( 0 , count($lastname) -1)];
		return $name;
	}

	function randomFirstName() {
		$firstname = array(
			'Johnathon',
			'Anthony',
			'Erasmo',
			'Raleigh',
			'Nancie',
			'Tama',
			'Camellia',
			'Augustine',
			'Christeen',
			'Luz',
			'Diego',
			'Lyndia',
			'Thomas',
			'Georgianna',
			'Leigha',
			'Alejandro',
			'Marquis',
			'Joan',
			'Stephania',
			'Elroy',
			'Zonia',
			'Buffy',
			'Sharie',
			'Blythe',
			'Gaylene',
			'Elida',
			'Randy',
			'Margarete',
			'Margarett',
			'Dion',
			'Tomi',
			'Arden',
			'Clora',
			'Laine',
			'Becki',
			'Margherita',
			'Bong',
			'Jeanice',
			'Qiana',
			'Lawanda',
			'Rebecka',
			'Maribel',
			'Tami',
			'Yuri',
			'Michele',
			'Rubi',
			'Larisa',
			'Lloyd',
			'Tyisha',
			'Samatha',
		);
		$name = $firstname[rand ( 0 , count($firstname) -1)];
		return $name;

	}


	// fill two arrays of 400 random names
	for ($x = 0; $x < 400; $x++) {
		$myFirstName = randomFirstName();
		array_push($firstNameArr, $myFirstName);

		// fill an array of 400 random last names
		$myLastName = randomLastName();
		array_push($lastNameArr, $myLastName);
	}

	// create specialized array for fputscsv function
	$dataList = array (
		array("EmployeeID", "EmployeeFirstName", "EmployeeLastName")
	);

	$idInt = 1;
	for ($i = 0; $i < 400; $i++) {
		$idInt = $i + 10;
		$addedArray = array($idInt, $firstNameArr[$i], $lastNameArr[$i]);
		array_push($dataList, $addedArray);
	}

	// test to view the final data array
	// print_r($dataList);

	// bind the csv file to the stream
	$file = fopen("employeeData.csv", "w");

	foreach ($dataList as $line) {
	fputcsv($file, $line);
	}

	// close the file to the stream
	fclose($file);
	header('Location: employeeData.csv');  
	exit;
	
	?>