<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;
use \Hcode\Model\Laboratory;
use \Hcode\Model\SpecialControl;
use \Hcode\Model\TypesMedicine;
use \Hcode\Model\Therapeutic_Classes;

$app->get('/admin/products', function(){

	User::verifyLogin();

	$products = Product::listAll();

	$page = new PageAdmin();

	$page->setTpl("products", [

		"products"=>$products

	]);

});

$app->get('/admin/products/:idproduct/delete', function($idproduct){

	User::verifyLogin();

	$product = new Product();

	$product->get((int)$idproduct);

	$product->delete();

	header("Location: /admin/products");

	exit;
});

$app->get('/admin/products/create', function(){

	User::verifyLogin();	

	$laboratories = Laboratory::listAll();	

	$therapeutic_Classes = Therapeutic_Classes::listAll();

	$page = new PageAdmin();

	$page->setTpl("products-create", [
		
		'therapeutic_Classes'=>$therapeutic_Classes,
		'laboratories'=>$laboratories

	]);

});

$app->post('/admin/products/create', function(){

	User::verifyLogin();

	$product = new Product();

	$_POST["recipe"] = (isset($_POST["recipe"])) ? 1 : 0;	
	
	$product->setData($_POST);

	var_dump($_POST);

	$product->save();

	header("Location: /admin/products");

	exit;

});

$app->get('/admin/products/:idproduct', function($idproduct){

	User::verifyLogin();

	$product = new Product();

	$product->get((int)$idproduct);

	$page = new PageAdmin();

	$page->setTpl("products-update", array(
		"product"=>$product->getValues()

	));

});

$app->post('/admin/products/:idproduct', function($idproduct){

	User::verifyLogin();

	$product = new Product();

	$_POST["recipe"] = (isset($_POST["recipe"])) ? 1 : 0;

	$product->get((int)$idproduct);	

	$product->setData($_POST);

	$product->save();

	header("Location: /admin/products");

	exit;
	

});




?>