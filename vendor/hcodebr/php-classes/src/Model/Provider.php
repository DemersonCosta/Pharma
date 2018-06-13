<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Provider extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_provider
        ORDER BY provider");

    }

    public function save()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_providers_save(:idprovider, :provider, :cnpj, :address)", array(
            
            ":idprovider"=>$this->getidprovider(),
            ":provider"=>$this->getprovider(),
            ":cnpj"=>$this->getcnpj(),
            ":address"=>$this->getaddress()
                     
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

        $sql->query("DELETE FROM tb_provider WHERE idprovider = :idprovider", [

            ":idprovider"=>$this->getidprovider()

        ]);
       
    }

    
    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_providers_save(:provider, :cnpj, :address)", array(           
           
            ":idprovider"=>$this->getidprovider(),
            ":provider"=>$this->getprovider(),
            ":cnpj"=>$this->getcnpj(),
            ":address"=>$this->getaddress()
                     
        ));

    }

    public function get($idprovider)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_provider WHERE idprovider = :idprovider", [
            ":idprovider"=>$idprovider
        ]);

        $this->setData($results[0]);
    }

}
?>