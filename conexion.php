
<?php

class Cconexion{
    public static function ConexionBD(){
        $host='localhost';
        $dbname='FAZ_CAR_QUEVEDO2';
        $username='sa';
        $pasword='12345678';
        $puerto= 1433;

        try{
            $conn= new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname",$username,$pasword);
            echo "CONECTADO";
           



        }
        catch(PDOException $exp){
            echo ("no se conecto :$dbname, error: $exp");


        }
        return $conn;
    }

}
