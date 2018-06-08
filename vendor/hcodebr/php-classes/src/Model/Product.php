<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Product extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT a.idproduct,a.drugname,a.barcode,a.msregistry,a.price,a.recipe,a.discount, b.laboratory FROM tb_products a 
        INNER JOIN tb_laboratories b ON b.idlaboratory = a.idlaboratory
        ORDER BY a.drugname ASC");

    }

    public function save()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_products_save(:idproduct, :drugname, :barcode, 
                                                        :msregistry, :price, :recipe, 
                                                        :discount, :idlaboratory, :idtherapeutic_classes, 
                                                        :idspecialcontrol, :idtypesmedicine)", array(
                                                                    
            ":idproduct"=>$this->getidproduct(),
            ":drugname"=>$this->getdrugname(), 
            ":barcode"=>$this->getbarcode(), 
            ":msregistry"=>$this->getmsregistry(), 
            ":price"=>$this->getprice(), 
            ":recipe"=>$this->getrecipe(), 
            ":discount"=>$this->getdiscount(),
            ":idlaboratory"=>$this->getidlaboratory(),
            ":idtherapeutic_classes"=>$this->getidtherapeutic_classes(),
            ":idspecialcontrol"=>$this->getidspecialcontrol(),
            ":idtypesmedicine"=>$this->getidtypesmedicine()              
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

    public function getValues()
    {
        $this->checkPhoto();

        $values = parent::getValues();
    
        return $values;

    }

    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_products_save(:drugname, :barcode, :msregistry, :price, :recipe, :discount, :idlaboratory, :idtherapeutic_classes, :idspecialcontrol, :idtypesmedicine)", array(
                      
            ":drugname"=>$this->getdrugname(), 
            ":barcode"=>$this->getbarcode(), 
            ":msregistry"=>$this->getmsregistry(), 
            ":price"=>$this->getprice(), 
            ":recipe"=>$this->getrecipe(), 
            ":discount"=>$this->getdiscount(),
            ":idlaboratory"=>$this->getlaboratory(),
            ":idtherapeutic_classes"=>$this->getidtherapeutic_classes(),
            ":idspecialcontrol"=>$this->getidspecialcontrol(),
            ":idtypesmedicine"=>$this->getidtypesmedicine()    

        ));

    }
    
    public static function checkList($List)
    {
        foreach ($List as &$row) {
          
          $p = new Product();
          $p->setData($row);
          $row = $p->getValues();
        }
        return $List;
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