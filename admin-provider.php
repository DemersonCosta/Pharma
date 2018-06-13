<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Provider;

$app->get('/admin/providers', function(){

	User::verifyLogin();

	$providers = Provider::listAll();

	$page = new PageAdmin();

	$page->setTpl("providers", array(

		"providers"=>$providers

	));

});

$app->get('/admin/providers/create', function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("providers-create");

});


$app->post('/admin/providers/create', function(){

	User::verifyLogin();

    $provider = new Provider();   

	$provider->setData($_POST);
	//var_dump($_POST);
	$provider->save();

	header("Location: /admin/providers");

	exit;

});

$app->get('/admin/providers/:idprovider/delete', function($idprovider){

	User::verifyLogin();

    $provider = new Provider();	
    
	$provider->get((int)$idprovider);

	$provider->delete();

	header("Location: /admin/providers");

	exit;

});

$app->get('/admin/providers/:idprovider', function($idprovider){

	User::verifyLogin();

	$provider = new Provider();

	$provider->get((int)$idprovider);

	$page = new PageAdmin();

	$page->setTpl("providers-update", array(
		"provider"=>$provider->getValues()

	));

});

$app->post('/admin/providers/:idprovider', function($idprovider){

	User::verifyLogin();

	$provider = new Provider();	    

    $provider->get((int)$idprovider);
    //var_dump($_POST);
	$provider->setData($_POST);

	$provider->save();

	header("Location: /admin/providers");

	exit;
	

});





?>