<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class SpecialControl extends Model {
     
    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_specialcontrol
        ORDER BY specialcontrol");

    }
   

    public function get($idspecialcontrol)
    {

        $sql =  new Sql();

        $results = $sql->select("SELECT * FROM tb_specialcontrol WHERE idspecialcontrol = :idspecialcontrol", [
            ":idspecialcontrol"=>$idspecialcontrol
        ]);

        $this->setData($results[0]);
    }

}
?>