
<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;
use \Hcode\Model\Cart;

//rota para o carrinho 
$app->get('/admin/cart', function(){

	$cart = Cart::getFromSession();
	
	$page = new PageAdmin();

	$page->setTpl("cart");

});
