<?php

use \Hcode\Page;
use \Hcode\Model\Product;
use \Hcode\Model\Category;
use \Hcode\Model\Cart;

$app->get('/', function() {
    
    //$products = Product::listAll();

    $page = new Page();

    $page->setTpl("index");
   /* $page->setTpl("index",[
    	'products'=>Product::checkList($products)
    ]);*/

});




?>