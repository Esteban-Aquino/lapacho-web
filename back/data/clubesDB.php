<?php

/**
 * ABM clientes
 * Autor: Esteban Aquino
 * Empresa: LeaderIT
 * Fecha: 02/10/2020
 */



class clubesDB {

    function __construct() {
        
    }
    
    public static function insertaClub($club) {
        try {
            $id = 0;
            
            $sql = "INSERT INTO CLUBES (nombre, ciudad, direccion)
                    VALUES  (:nombre, :ciudad, :direccion);";
            // Preparar sentencia
            //print_r($cliente);
            //print $persona['NOMBRE'];
            $dbh = myconnect::getInstance()->getDb();
            $comando = $dbh->prepare($sql);
            
            $comando->bindParam(':nombre', $club['NOMBRE'], PDO::PARAM_STR);
            $comando->bindParam(':ciudad', $club['CIUDAD'], PDO::PARAM_STR);
            $comando->bindParam(':direccion', $club['DIRECCION'], PDO::PARAM_STR);

            $dbh->beginTransaction();
            $comando->execute();
            $id = $dbh->lastInsertId();
            $dbh->commit();
            
            
            return $id;
        } catch (PDOException $e) {
            $dbh->rollback();
            //print $e->getMessage();
            return utf8_converter_sting($e->getMessage());
        }
    }
    
    
    public static function borraClub($id) {
        try {
            
            $sql = "DELETE FROM CLUBES WHERE ID = :ID;";
            // Preparar sentencia
            //print_r($cliente);
            //print $persona['NOMBRE'];
            $dbh = myconnect::getInstance()->getDb();
            $comando = $dbh->prepare($sql);
            
            $comando->bindParam(':ID', $id, PDO::PARAM_STR);
            $dbh->beginTransaction();
            $comando->execute();
            $dbh->commit();
            
            
            return $id;
        } catch (PDOException $e) {
            $dbh->rollback();
            //print $e->getMessage();
            return utf8_converter_sting($e->getMessage());
        }
    }

    
   public static function actualizaClubes($id, $cliente) {
        try {
            
            $sql = "UPDATE CLUBES 
                    SET nombre = :nombre, 
                        ciudad = :ciudad, 
                        direccion = :direccion
                    WHERE ID = :ID;";
            // Preparar sentencia
            // print ($sql);
            //print $persona['NOMBRE'];
            $dbh = myconnect::getInstance()->getDb();
            $comando = $dbh->prepare($sql);
            
            $comando->bindParam(':nombre', $cliente['NOMBRE'], PDO::PARAM_STR);
            $comando->bindParam(':ciudad', $cliente['CIUDAD'], PDO::PARAM_STR);
            $comando->bindParam(':direccion', $cliente['DIRECCION'], PDO::PARAM_STR);
            $comando->bindParam(':ID', intval($id), PDO::PARAM_INT);
            $dbh->beginTransaction();
            $comando->execute();
            $dbh->commit();
            
            
            return $id;
        } catch (PDOException $e) {
            $dbh->rollback();
            //print $e->getMessage();
            return utf8_converter_sting($e->getMessage());
        }
    } 
    
    
    public static function getClubes($id, $BUSCAR) {
        try {
            $cant = 10;
            //print($id);
            //print_r($BUSCAR);
            $sql = "SELECT  C.ID,
                            C.NOMBRE,
                            C.CIUDAD,
                            C.DIRECCION
                        FROM clubes c
                        WHERE (c.id = :ID OR :ID1 = '')
                    AND (c.NOMBRE LIKE CONCAT('%',:NOMBRE,'%') 
                         OR c.CIUDAD LIKE CONCAT('%',:CIUDAD,'%') 
                         OR UPPER(C.DIRECCION) LIKE CONCAT('%',UPPER(:DIRECCION),'%')  )";

            $dbh = myconnect::getInstance()->getDb();
            $comando = $dbh->prepare($sql);
            //print($sql);
            // Ejecutar sentencia preparada
             $comando->bindParam(':ID', $id, PDO::PARAM_STR);
             $comando->bindParam(':ID1', $id, PDO::PARAM_STR);
             $comando->bindParam(':NOMBRE', $BUSCAR, PDO::PARAM_STR);
             $comando->bindParam(':CIUDAD', $BUSCAR, PDO::PARAM_STR);
             $comando->bindParam(':DIRECCION', $BUSCAR, PDO::PARAM_STR);
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            //PRINT_R($result);
            return utf8_converter($result);
        } catch (PDOException $e) {
            //print_r($e->getMessage());
            return utf8_converter_sting($e->getMessage());
        }
    }
    
    
    
    
    
    
    
    
    
    
 }



