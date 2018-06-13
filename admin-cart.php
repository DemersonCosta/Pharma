
<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;
use \Hcode\Model\Cart;

//rota para o carrinho 
$app->get('/admin/cart', function(){

	$cart = Cart::getFromSession();

	$page = new PageAdmin();

	$total = $cart->getProductsTotals();

	if ($total['pricetotal'] == NULL) {
		
	$total['pricetotal'] = 0;
		
	$page->setTpl("/admin/cart",[
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts(),
		'total'=>$total
	]);

	exit();
	}

	$page->setTpl("/admin/cart",[
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts(),
		'total'=>$cart->getProductsTotals()
	]);

});


$app->get('/admin/cart/:idproduct/add', function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);	

	$cart = Cart::getFromSession();

	$cart->addProduct($product);
	
	header("Location: /admin/cart");

	exit();

});

$app->get('/admin/cart/:idproduct/minus', function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);	

	$cart = Cart::getFromSession();

	$cart->removeProduct($product);
	
	header("Location: /admin/cart");

	exit();

});

$app->get('/admin/cart/:idproduct/remove', function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);	

	$cart = Cart::getFromSession();

	$cart->removeProduct($product, true);
	
	header("Location: /admin/cart");

	exit();

});


?>
