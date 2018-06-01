<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Product extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT a.idproduct,a.drugname,a.barcode,a.msregistry,a.price,a.recipe,a.discount, b.laboratory FROM tb_products a 
        INNER JOIN tb_laboratories b ON b.idlaboratory = a.laboratory_idlaboratory
        ORDER BY a.drugname ASC");

    }

    public function save()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_products_save(:idproduct, :drugname, :barcode, :msregistry, :price, :recipe, :discount, :laboratory_idlaboratory)", array(
            
            ":idproduct"=>$this->getidproduct(),
            ":drugname"=>$this->getdrugname(), 
            ":barcode"=>$this->getbarcode(), 
            ":msregistry"=>$this->getmsregistry(), 
            ":price"=>$this->getprice(), 
            ":recipe"=>$this->getrecipe(), 
            ":discount"=>$this->getdiscount(),
            ":laboratory_idlaboratory"=>$this->getlaboratory()            
        ));

        $this->setData($results[0]);
      
    } 

    public function delete()
    {

        $sql = new Sql();

        $sql->query("DELETE FROM tb_products WHERE idproduct = :idproduct", [

            ":idproduct"=>$this->getidproduct()

        ]);
       
    }

    
    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_products_save(:drugname, :barcode, :msregistry, :price, :recipe, :discount, :laboratory_idlaboratory)", array(
                      
            ":drugname"=>$this->getdrugname(), 
            ":barcode"=>$this->getbarcode(), 
            ":msregistry"=>$this->getmsregistry(), 
            ":price"=>$this->getprice(), 
            ":recipe"=>$this->getrecipe(), 
            ":discount"=>$this->getdiscount(),
            ":laboratory_idlaboratory"=>$this->getlaboratory()            
        ));

    }

    public function get($idproduct)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_products WHERE idproduct = :idproduct", [
            ":idproduct"=>$idproduct
        ]);

        $this->setData($results[0]);
    }

}
?>