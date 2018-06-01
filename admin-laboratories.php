<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Laboratory;

$app->get('/admin/laboratories', function(){

	User::verifyLogin();

	$laboratories = Laboratory::listAll();

	$page = new PageAdmin();

	$page->setTpl("laboratories", array(

		"laboratories"=>$laboratories

	));

});

$app->get('/admin/laboratories/create', function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("laboratories-create");

});

$app->get('/admin/laboratories/:idlaboratory/delete', function($idlaboratory){

	User::verifyLogin();

    $laboratory = new Laboratory();	
    
	$laboratory->get((int)$idlaboratory);

	$laboratory->delete();

	header("Location: /admin/laboratories");

	exit;

});

$app->post('/admin/laboratories/create', function(){

	User::verifyLogin();

    $laboratory = new Laboratory();	
    
    var_dump($_POST);

	$laboratory->setData($_POST);

	$laboratory->save();

	header("Location: /admin/laboratories");

	exit;

});

$app->get('/admin/laboratories/:idlaboratory', function($idlaboratory){

	User::verifyLogin();

	$laboratory = new Laboratory();	

	$laboratory->get((int)$idlaboratory);

	$page = new PageAdmin();

	$page->setTpl("laboratories-update", array(
		"laboratory"=>$laboratory->getValues()

	));

});

$app->post('/admin/laboratories/:idlaboratory', function($idlaboratory){

	User::verifyLogin();

	$laboratory = new Laboratory();	    

    $laboratory->get((int)$idlaboratory);
    var_dump($_POST);
	$laboratory->setData($_POST);

	$laboratory->save();

	header("Location: /admin/laboratories");

	exit;
	

});



?>