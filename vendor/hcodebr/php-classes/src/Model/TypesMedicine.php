<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class TypesMedicine extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_typesmedicine
        ORDER BY typesmedicine");

    }
   

    public function get($idspecialcontrol)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_typesmedicine WHERE idtypesmedicine = :idtypesmedicine", [
            ":idtypesmedicine"=>$idtypesmedicine
        ]);

        $this->setData($results[0]);
    }

}
?>