<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Active_Principles extends Model {	

    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_active_principles ORDER BY active_principles");

     }  

    public function save()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_active_principles_save(:idactive_principles, :active_principles)", array(
            ":idactive_principles"=>$this->getidactive_principles(),
            ":active_principles"=>$this->getactive_principles()            
        ));

        $this->setData($results[0]);
     
    } 

    public function get($idactive_principle)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_active_principles WHERE idactive_principles = :idactive_principles", [
            ":idactive_principles"=>$idactive_principle
        ]);
        
        $this->setData($results[0]);
    }

    public function delete()
    {
        $sql = new Sql();

        $sql->query("DELETE FROM tb_active_principles WHERE idactive_principles = :idactive_principles", [

            ":idactive_principles"=>$this->getidactive_principles()

        ]);       
    }

  
    public function getProducts($related = true)
    {
        $sql = new Sql();

        if ($related === true) {
            return $sql->select("
            SELECT * FROM tb_products WHERE idproduct IN(
                SELECT a.idproduct 
                FROM tb_products a 
                INNER JOIN tb_products_principles b ON a.idproduct = b.idproduct
                WHERE b.idactive_principles  = :idactive_principles
            );

            ",[
                ':idactive_principles'=>$this->getidactive_principles()
            ]);
        } else {
            return $sql->select("
            SELECT * FROM tb_products WHERE idproduct NOT  IN(
                SELECT a.idproduct FROM tb_products a 
                INNER JOIN tb_products_principles b 
                ON a.idproduct = b.idproduct
                WHERE b.idactive_principles  = :idactive_principles
            );
            ",[
                ':idactive_principles'=>$this->getidactive_principles()
            ]);
        }

    }

    public function addProduct(Product $product){

        $sql = new Sql();

        $sql->query("INSERT INTO tb_products_principles (idactive_principles, idproduct) VALUES(:idactive_principles, :idproduct)", [
            ':idactive_principles'=>$this->getidactive_principles(),
            ':idproduct'=>$product->getidproduct()
        ]);
    }

    public function removeProduct(Product $product){

        $sql = new Sql();

        $sql->query("DELETE FROM tb_products_principles WHERE idactive_principles = :idactive_principles AND idproduct = :idproduct", [
            ':idactive_principles'=>$this->getidactive_principles(),
            ':idproduct'=>$product->getidproduct()
        ]);
    }  

  
}

?>