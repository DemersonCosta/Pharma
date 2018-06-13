<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Lot extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_lot");

    }

    public function save()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_lots_save(:idlot, :description, :expiration_date, :fabrication_date)", array(
            
            ":idlot"=>$this->getidlot(),
            ":description"=>$this->getdescription(),
            ":expiration_date"=>$this->getexpiration_date(),
            ":fabrication_date"=>$this->getfabrication_date()
                     
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

        $sql->query("DELETE FROM tb_lot WHERE idlot = :idlot", [

            ":idlot"=>$this->getidlot()

        ]);
       
    }

    
    public function update()
    {

        $sql = new Sql();
      
        $results = $sql->select("CALL sp_lots_save(:description, :expiration_date, :fabrication_date)", array(
            
            ":description"=>$this->getdescription(),
            ":expiration_date"=>$this->getexpiration_date(),
            ":fabrication_date"=>$this->getfabrication_date()
                     
        ));

    }

    public function get($idlot)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_lot WHERE idlot = :idlot", [
            ":idlot"=>$idlot
        ]);

        $this->setData($results[0]);
    }

}

?>