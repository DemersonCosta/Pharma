<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Therapeutic_Classes extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_therapeutic_classes
        ORDER BY therapeutic_class");

    }

    public function save()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_therapeutic_classes_save(:idtherapeutic_classes, :therapeutic_class)", array(
            
            ":idtherapeutic_classes"=>$this->getidtherapeutic_classes(),
            ":therapeutic_class"=>$this->gettherapeutic_class()
                     
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

        $sql->query("DELETE FROM tb_therapeutic_classes WHERE idtherapeutic_classes = :idtherapeutic_classes", [

            ":idtherapeutic_classes"=>$this->getidtherapeutic_classes()

        ]);
       
    }

    
    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_therapeutic_classes_save(:therapeutic_class)", array(           
           
            ":therapeutic_class"=>$this->gettherapeutic_class()
                     
        ));

    }

    public function get($idtherapeutic_classes)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_therapeutic_classes WHERE idtherapeutic_classes = :idtherapeutic_classes", [
            ":idtherapeutic_classes"=>$idtherapeutic_classes
        ]);

        $this->setData($results[0]);
    }

}
?>