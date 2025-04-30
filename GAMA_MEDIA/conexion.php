<<<<<<< HEAD
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





=======
<<<<<<< HEAD
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





=======
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





>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
?>