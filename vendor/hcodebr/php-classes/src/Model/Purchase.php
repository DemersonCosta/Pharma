<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Purchase extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_purchase");

    }

    public function save()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_purchases_save(:idpurchase, :entry_date, :total, :cpf)", array(
            
            ":idpurchase"=>$this->getidpurchase(),
            ":entry_date"=>$this->getentry_date(),
            ":total"=>$this->gettotal(),
            ":cpf"=>$this->getcpf()
                     
        ));

        $this->setData($results[0]);
      
    } 

    public function getValues()
    {        

        $values = parent::getValues();
    
        return $values;

    }

    public function delete()
    {

        $sql = new Sql();

        $sql->query("DELETE FROM tb_purchase WHERE idpurchase = :idpurchase", [

            ":idpurchase"=>$this->getidlot()

        ]);
       
    }

    
    public function update()
    {

        $sql = new Sql();
      
        $results = $sql->select("CALL sp_purchases_save(:entry_date, :total, :cpf)", array(
            
            
            ":entry_date"=>$this->getentry_date(),
            ":total"=>$this->gettotal(),
            ":cpf"=>$this->getcpf()
                     
        ));

    }

    public function get($idpurchase)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_purchase WHERE idpurchase = :idpurchase", [
            ":idpurchase"=>$idpurchase
        ]);

        $this->setData($results[0]);
    }

}

?>