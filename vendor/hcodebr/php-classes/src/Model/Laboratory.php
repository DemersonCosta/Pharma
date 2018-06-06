<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class laboratory extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_laboratories
        ORDER BY laboratory");

    }

    public function save()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_laboratories_save(:idlaboratory, :laboratory)", array(
            
            ":idlaboratory"=>$this->getidlaboratory(),
            ":laboratory"=>$this->getlaboratory()
                     
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

        $sql->query("DELETE FROM tb_laboratories WHERE idlaboratory = :idlaboratory", [

            ":idlaboratory"=>$this->getidlaboratory()

        ]);
       
    }

    
    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_laboratories_save(:laboratory)", array(           
           
            ":laboratory"=>$this->getlaboratory()
                     
        ));

    }

    public function get($idlaboratory)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_laboratories WHERE idlaboratory = :idlaboratory", [
            ":idlaboratory"=>$idlaboratory
        ]);

        $this->setData($results[0]);
    }

}
?>