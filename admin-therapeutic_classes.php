<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Therapeutic_Classes;

$app->get('/admin/therapeutic_classes', function(){

	User::verifyLogin();

	$therapeutic_classes = Therapeutic_Classes::listAll();

	$page = new PageAdmin();

	$page->setTpl("therapeutic_classes", array(

		"therapeutic_classes"=>$therapeutic_classes

	));

});

$app->get('/admin/therapeutic_classes/create', function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("therapeutic_classes-create");

});


$app->post('/admin/therapeutic_classes/create', function(){

	User::verifyLogin();

    $therapeutic_classes = new Therapeutic_Classes();   

	$therapeutic_classes->setData($_POST);
	//var_dump($_POST);
	$therapeutic_classes->save();

	header("Location: /admin/therapeutic_classes");

	exit;

});

$app->get('/admin/therapeutic_classes/:idtherapeutic_classes/delete', function($idtherapeutic_classes){

	User::verifyLogin();

    $therapeutic_classes = new Therapeutic_Classes();	
    
	$therapeutic_classes->get((int)$idtherapeutic_classes);

	$therapeutic_classes->delete();

	header("Location: /admin/therapeutic_classes");

	exit;

});

$app->get('/admin/therapeutic_classes/:idtherapeutic_classes', function($idtherapeutic_classes){

	User::verifyLogin();

	$therapeutic_class = new Therapeutic_Classes();	

	$therapeutic_class->get((int)$idtherapeutic_classes);

	$page = new PageAdmin();

	$page->setTpl("therapeutic_classes-update", array(
		"therapeutic_class"=>$therapeutic_class->getValues()

	));

});

$app->post('/admin/therapeutic_classes/:idtherapeutic_classes', function($idtherapeutic_classes){

	User::verifyLogin();

	$therapeutic_class = new Therapeutic_Classes();	    

    $therapeutic_class->get((int)$idtherapeutic_classes);
    //var_dump($_POST);
	$therapeutic_class->setData($_POST);

	$therapeutic_class->save();

	header("Location: /admin/therapeutic_classes");

	exit;
	

});





?>