
<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Purchase;

$app->get('/admin/purchases', function(){

	User::verifyLogin();

	$purchases = Purchase::listAll();
	//var_dump($purchases);
	//exit();
	$page = new PageAdmin();

	$page->setTpl("purchases", array(

		"purchases"=>$purchases

	));

});

$app->get('/admin/laboratories/create', function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("laboratories-create");

});


$app->post('/admin/laboratories/create', function(){

	User::verifyLogin();

    $laboratory = new Laboratory();   

	$laboratory->setData($_POST);
	//var_dump($_POST);
	$laboratory->save();

	header("Location: /admin/laboratories");

	exit;

});

$app->get('/admin/laboratories/:idlaboratory/delete', function($idlaboratory){

	User::verifyLogin();

    $laboratory = new Laboratory();	
    
	$laboratory->get((int)$idlaboratory);

	$laboratory->delete();

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
    //var_dump($_POST);
	$laboratory->setData($_POST);

	$laboratory->save();

	header("Location: /admin/laboratories");

	exit;
	

});





?>