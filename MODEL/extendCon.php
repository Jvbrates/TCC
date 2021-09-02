<?php
class  extendCon
{

    private static $con;
    public function __construct()
    {
        $this->con = ConnectionDB::getConnection();
    }

    protected static function query($sql, $parametros)
    {   
        $con = extendCon::$con;
        if($prepare = $con()->prepare($sql))
        {   
            foreach($parametros as $key=> &$valor){
                $prepare->bindParam(":{$key}", $valor);
            }
    
            //return $prepare->debugDumpParams();
    
            if($prepare->execute()){
                return $prepare;    
            }   
        }
        return false;
    }

}

?>