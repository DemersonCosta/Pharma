<?php
	
namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;
use \Hcode\Model\User;
use \Hcode\Model\Product;


class Cart extends Model {	

	const SESSION = "idcart";
	const SESSION_ERROR = "CartErro";

	public static function getFromSession()
	{
		$cart = new Cart();

		if (isset($_SESSION[Cart::SESSION]) && (int)$_SESSION[Cart::SESSION]['idcart'] > 0) {

			 $cart->get((int)$_SESSION[Cart::SESSION]['idcart']);

		} else {

			$cart->getFromSessionID();

			if (!(int)$cart->getidcart() > 0) {
				
				$data = [
					'dessessionid'=>session_id()
				];

				if (User::checkLogin(false)) {
					
					$user = User::getFromSession(); 
					$data['iduser'] = $user->getiduser();
				}
				
				$cart->setData($data);

				$cart->save();

				$cart->setToSession();

			}
		}

		return $cart;

	}	

	public function setToSession()
	{
		$_SESSION[Cart::SESSION] = $this->getValues();
	}

	public function getFromSessionID()
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carts WHERE dessessionid = :dessessionid", [

			':dessessionid'=>session_id()

		]);

		if (count($results) > 0) {

			$this->setData($results[0]);

		}
	}

	public function get(int $idcart){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carts WHERE idcart = :idcart", [

			':idcart'=>$idcart

		]);

		if (count($results) > 0) {

			$this->setData($results[0]);

		}
	}

	public function save(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_carts_save(:idcart, :dessessionid, :iduser, :deszipcode, :vlfreight, :nrdays)", [

			':idcart'=>$this->getidcart(),
			':dessessionid'=>$this->getdessessionid(),
			':iduser'=>$this->getiduser(),
			':deszipcode'=>$this->getdeszipcode(),
			':vlfreight'=>$this->getvlfreight(),
			':nrdays'=>$this->getnrdays()
			
		]);

		$this->setData($results[0]);

	}
    
	public function addProduct(Product $product)
	{

		$sql = new Sql();

		$sql->query("INSERT INTO tb_cartsproducts (idcart, idproduct) VALUES(:idcart, :idproduct)",[
			':idcart'=>$this->getidcart(),
			':idproduct'=>$product->getidproduct()
		]);
	}

	public function removeProduct(Product $product, $all = false)
	{

		$sql = new Sql();

		if ($all) {

			 $sql->query("UPDATE tb_cartsproducts SET dtremoved = NOW() WHERE idcart = :idcart AND idproduct = :idproduct AND dtremoved IS NULL", [

			 	'idcart'=>$this->getidcart(),
			 	'idproduct'=>$product->getidproduct()
			 ]);

		} else {

		 $sql->query("UPDATE tb_cartsproducts SET dtremoved = NOW() WHERE idcart = :idcart AND idproduct = :idproduct AND dtremoved IS NULL LIMIT 1", [
			 	
			 	'idcart'=>$this->getidcart(),
			 	'idproduct'=>$product->getidproduct()
			 ]);
		}

	}

	public function getProducts()
	{

		$sql = new Sql();
		
		$rows = $sql->select("
			   SELECT b.idproduct, b.drugname, b.msregistry, b.barcode, b.recipe, 
			      b.idlaboratory, b.idtherapeutic_classes, b.idspecialcontrol, b.idtypesmedicine, b.price,b.discount,
			      COUNT(*) AS nrqtd,SUM(b.price) AS vltotal      
			      FROM tb_cartsproducts a 
			      INNER JOIN tb_products b ON a.idproduct = b.idproduct
			      WHERE a.idcart = :idcart AND a.dtremoved IS NULL 
			      GROUP BY b.idproduct, b.drugname, b.msregistry, b.barcode,
			      b.recipe, b.idlaboratory, b.idtherapeutic_classes, 
			      b.idspecialcontrol, b.idtypesmedicine, b.price, b.discount
			      ORDER BY b.drugname
			", [
				':idcart'=>$this->getidcart()

			]);

		return Product::checkList($rows);
	}  

	public function getProductsTotals()
	{

		$sql = new Sql();
		
		$results = $sql->select("
			SELECT SUM(price) AS pricetotal, COUNT(*) AS nrqtd FROM tb_products a 
			INNER JOIN tb_cartsproducts b on a.idproduct = b.idproduct
			WHERE idcart = :idcart AND dtremoved IS NULL

			", [
				':idcart'=>$this->getidcart()

			]);

		if (count($results) > 0) {
			
			return $results[0];

		}else{

			 return [];
			
		}
	}  

}


?>