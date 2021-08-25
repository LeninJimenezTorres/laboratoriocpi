<?php
class ConexionRegistrosDB{
    // ESTA CLASE MODELO SE DESTINA EXCLUSIVAMENTE A LA CONEXION PDO CON LA BASE DE DATOS.
    static public function conectar(){
        // PDO (servidor, db, user, contraseña)
        try{
            $link = new PDO("mysql:host=localhost;
            dbname=scol",
            "root",
            "");
            
            $link->exec("set names utf8");
            return $link;
        }
        catch(Exception $e){
            die('Error '.$e->getMessage()."<br> Base de datos no disponible");
        }
        finally{
            $link=null;
        }
    }
}
