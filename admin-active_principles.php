<?php 

use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Active_Principles;
use \Hcode\Model\Product;


$app->get('/admin/active_principles', function(){

	User::verifyLogin();

	$active_principles = Active_Principles::listAll();

	$page = new PageAdmin();

	$page->setTpl("active_principles", [

		'active_principles'=>$active_principles
	]);

});

$app->get('/admin/active_principles/create', function(){

	User::verifyLogin();

	$active_principles = Active_Principles::listAll();

	$page = new PageAdmin();

	$page->setTpl("active_principles-create");

});

$app->post('/admin/active_principles/create', function(){

	User::verifyLogin();

	$active_principle = new  Active_Principles();

	$active_principle->setData($_POST);

	$active_principle->save();

	header("Location: /admin/active_principles");

	exit;

});

$app->get('/admin/active_principles/:idactive_principles/delete', function($idactive_principles){
	
	User::verifyLogin();

	$active_principle = new Active_Principles();

	$active_principle->get((int)$idactive_principles);

	$active_principle->delete();

	header("Location: /admin/active_principles");

	exit;

});

$app->get('/admin/active_principles/:idactive_principles', function($idactive_principles){	

	User::verifyLogin();
	
	$active_principle = new Active_Principles();

	$active_principle->get((int)$idactive_principles);

	$page = new PageAdmin();	

	$page->setTpl("active_principles-update", [
		"active_principle"=>$active_principle->getValues()
	]);

});

$app->post('/admin/active_principles/:idactive_principles', function($idactive_principles){	

	User::verifyLogin();

	$active_principle = new Active_Principles();

	$active_principle->get((int)$idactive_principles);

	$active_principle->setData($_POST);

	$active_principle->save();

	header("Location: /admin/active_principles");

	exit;
});



$app->get('/admin/active_principles/:idactive_principles/products', function($idactive_principles){

	User::verifyLogin();

	$active_principle = new Active_Principles();
	
	$active_principle->get((int)$idactive_principles);
	
	$page = new PageAdmin();

	$page->setTpl("active_principles-products", [
		'active_principle'=>$active_principle->getValues(),
		'productsRelated'=>$active_principle->getProducts(),
		'productsNotRelated'=>$active_principle->getProducts(false)

	]);

});

$app->get('/admin/active_principles/:idactive_principles/products/:idproduct/add', function($idactive_principles, $idproduct){

	User::verifyLogin();

	$active_principle = new Active_Principles();

	$active_principle->get((int)$idactive_principles);

	$product = new Product();
	
	$product->get((int)$idproduct);
	
	$active_principle->addProduct($product);

	header("Location: /admin/active_principles/".$idactive_principles."/products");

	exit;
	
});

$app->get('/admin/active_principles/:idactive_principles/products/:idproduct/remove', function($idactive_principles, $idproduct){

	User::verifyLogin();

	$active_principle = new Active_Principles();

	$active_principle->get((int)$idactive_principles);

	$product = new Product();

	$product->get((int)$idproduct);

	$active_principle->removeProduct($product);

	header("Location: /admin/active_principles/".$idactive_principles."/products");

	exit;
	
});


?>