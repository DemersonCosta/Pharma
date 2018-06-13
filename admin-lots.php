<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Lot;

$app->get('/admin/lots', function(){

	User::verifyLogin();

	$lots = Lot::listAll();

	$page = new PageAdmin();

	$page->setTpl("lots", array(

		"lots"=>$lots

	));

});

$app->get('/admin/lots/create', function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("lots-create");

});


$app->post('/admin/lots/create', function(){

	User::verifyLogin();

    $lot = new Lot();   

	$lot->setData($_POST);
	//var_dump($_POST);
	$lot->save();

	header("Location: /admin/lots");

	exit;

});

$app->get('/admin/lots/:idlot/delete', function($idlot){

	User::verifyLogin();

    $lot = new Lot();	
    
	$lot->get((int)$idlot);

	$lot->delete();

	header("Location: /admin/lots");

	exit;

});


$app->get('/admin/lots/:idlot', function($idlot){

	User::verifyLogin();

	$lot = new Lot();

	$lot->get((int)$idlot);

	$page = new PageAdmin();

	$page->setTpl("lots-update", array(
		"lot"=>$lot->getValues()

	));

});

$app->post('/admin/lots/:idlot', function($idlot){

	User::verifyLogin();

	$lot = new Lot();	    

    $lot->get((int)$idlot);
    //var_dump($_POST);
	$lot->setData($_POST);

	$lot->save();

	header("Location: /admin/lots");

	exit;
	

});





?>