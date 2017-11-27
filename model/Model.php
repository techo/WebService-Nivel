<?php

class Model
{
    function LoginUser($cUser, $cPass)
    {
        require_once 'DBConfig.php';
        $sql = "SELECT COUNT(id) as qtd FROM usuario ";
        $sql.= "WHERE (mail = '".$cUser."' ";
        $sql.= "AND password = '". $cPass."')";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql); 
        $stmt->execute(); 
        $resultado = $stmt->fetchAll();
                
        if($resultado[0]['qtd'] == 1)
        {
            $Logado = true;
        }
        else
        {
            $Logado = false;
        }
         
        return $Logado;
    }
    
    function GravaToken($token, $ip, $iduser, $start, $end)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "INSERT INTO token (";
        $sql .= "id, ";
        $sql .= "token, ";
        $sql .= "ip_request, ";
        $sql .= "id_usuario, ";
        $sql .= "start_session, ";
        $sql .= "timeout_session) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $token ."', ";
        $sql .= "'". $ip ."', ";
        $sql .= "'". $iduser."', ";
        $sql .= "'". $start ."', ";
        $sql .= "'". $end."' )";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $bGravou = $stmt->rowCount();
        
        if($bGravou == 1)
        {
            $Logado = true;
        }
        else
        {
            $Logado = false;
        }
        
        return $Logado;
    }
    
    function checkToken($token)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT * FROM token ";
        $sql .= "WHERE token = '".$token."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function CheckUser($mail)
    {
        require_once 'DBConfig.php';
        $sql = "SELECT * FROM usuario ";
        $sql.= "WHERE mail = '".$mail."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function InfoUser($idUser)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "usuario.nombre as 'nombre', ";
        $sql .= "usuario.apellido_paterno as 'apellido_paterno', ";
        $sql .= "usuario.apellido_materno as 'apellido_materno' , ";
        $sql .= "usuario.mail as 'email' , ";
        $sql .= "usuario.status as 'status' , ";
        $sql .= "area.nombre as 'area', ";
        $sql .= "area.id as 'codarea', ";
        $sql .= "cargo.nombre as 'cargo', ";
        $sql .= "cargo.id as 'codcargo', ";
        $sql .= "pais.nombre  as 'pais', ";
        $sql .= "pais.id  as 'codpais' ";
        $sql .= "FROM usuario ";
        $sql .= "LEFT JOIN area ON area.id = usuario.id_area ";
        $sql .= "INNER JOIN cargo ON cargo.id = usuario.id_cargo ";
        $sql .= "INNER JOIN pais ON pais.id = usuario.id_pais ";
        $sql .= "WHERE usuario.id = '".$idUser."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function checkJefe($mail)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id_jefe ";
        $sql .= "FROM usuario ";
        $sql .= "WHERE mail = '".$mail."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function SearchJefe($idJefe)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "usuario.nombre, ";
        $sql .= "usuario.apellido_paterno, ";
        $sql .= "usuario.apellido_materno, ";
        $sql .= "usuario.mail, ";
        $sql .= "cargo.nombre as 'cargo'";   
        $sql .= "FROM usuario ";
        $sql .= "INNER JOIN cargo ON cargo.id = usuario.id_cargo ";
        $sql .= "WHERE usuario.id = '".$idJefe."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function CheckPais($CodPais)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id ";
        $sql .= "FROM pais ";
        $sql.= "WHERE codigo = '".$CodPais."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function ListContactAFF($CodPais)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "usuario.nombre, ";
        $sql .= "usuario.apellido_paterno, ";
        $sql .= "usuario.apellido_materno, ";
        $sql .= "usuario.mail, ";
        $sql .= "cargo.nombre as 'cargo'";
        $sql .= "FROM pais ";
        $sql .= "INNER JOIN usuario ON usuario.id = pais.id_aff ";
        $sql .= "INNER JOIN cargo ON cargo.id = usuario.id_cargo ";
        $sql.= "WHERE pais.codigo = '".$CodPais."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function ListContactCONT($CodPais)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "usuario.nombre, ";
        $sql .= "usuario.apellido_paterno, ";
        $sql .= "usuario.apellido_materno, ";
        $sql .= "usuario.mail, ";
        $sql .= "cargo.nombre as 'cargo'";
        $sql .= "FROM pais ";
        $sql .= "INNER JOIN usuario ON usuario.id = pais.id_cont ";
        $sql .= "INNER JOIN cargo ON cargo.id = usuario.id_cargo ";
        $sql.= "WHERE pais.codigo = '".$CodPais."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function InfoToken($token)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "token, ";
        $sql .= "ip_request, ";
        $sql .= "start_session, ";
        $sql .= "timeout_session ";
        $sql .= "FROM token ";
        $sql.= "WHERE token = '".$token."' ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function GrabarUsuario($nombre, $paterno, $materno, $email, $password, $area, $cargo, $pais, $jefe, $status, $idUser)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "INSERT INTO usuario (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "apellido_paterno, ";
        $sql .= "apellido_materno, ";
        $sql .= "mail, ";
        $sql .= "password, ";
        $sql .= "id_area, ";
        $sql .= "id_cargo, ";
        $sql .= "id_pais, ";
        $sql .= "id_jefe, ";
        $sql .= "status, ";
        $sql .= "id_criador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $nombre."', ";
        $sql .= "'". $paterno."', ";
        $sql .= "'". $materno."', ";
        $sql .= "'". $email."', ";
        $sql .= "'". $password."', ";
        $sql .= "'". $area."', ";
        $sql .= "'". $cargo."', ";
        $sql .= "'". $pais."', ";
        $sql .= "'". $jefe."', ";
        $sql .= "'". $status."', ";
        $sql .= "'". $idUser."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $bGravou = $stmt->rowCount();
        
        if($bGravou == 1)
        {
            $Logado = true;
        }
        else
        {
            $Logado = false;
        }
        
        return $Logado;
    }
    
    function GrabarPais($nombre, $codigo, $status, $idAff, $idCont, $idUser)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "INSERT INTO pais (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "status, ";
        $sql .= "id_aff, ";
        $sql .= "id_cont, ";
        $sql .= "id_criador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $nombre."', ";
        $sql .= "'". $codigo."', ";
        $sql .= "'". $status."', ";
        $sql .= "'". $idAff."', ";
        $sql .= "'". $idCont."', ";
        $sql .= "'". $idUser."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $bGravou = $stmt->rowCount();
        
        if($bGravou == 1)
        {
            $Logado = true;
        }
        else
        {
            $Logado = false;
        }
        
        return $Logado;
    }
    
    function GrabarArea($nombre, $codigo, $status, $idUser)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "INSERT INTO area (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "status, ";
        $sql .= "id_criador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $nombre."', ";
        $sql .= "'". $codigo."', ";
        $sql .= "'". $status."', ";
        $sql .= "'". $idUser."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $bGravou = $stmt->rowCount();
        
        if($bGravou == 1)
        {
            $Logado = true;
        }
        else
        {
            $Logado = false;
        }
        
        return $Logado;
    }
    
    function GrabarCargo($nombre, $status, $idUser)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "INSERT INTO cargo (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "status, ";
        $sql .= "id_criador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $nombre."', ";
        $sql .= "'". $status."', ";
        $sql .= "'". $idUser."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $bGravou = $stmt->rowCount();
        
        if($bGravou == 1)
        {
            $Logado = true;
        }
        else
        {
            $Logado = false;
        }
        
        return $Logado;
    }
    
    function ListArea()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo ";
        $sql .= "FROM area ";
        $sql.= "WHERE status = 1";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function ListCargo()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "nombre ";
        $sql .= "FROM cargo ";
        $sql.= "WHERE status = 1 ORDER BY nombre ASC";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function ListPais()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "nombre ";
        $sql .= "FROM pais ";
        $sql.= "WHERE status = 1 ORDER BY nombre ASC";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function ListJefe()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as 'nombre'";
        $sql .= "FROM usuario ";
        $sql.= "WHERE status = 1 ORDER BY nombre ASC";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function ListUsuarios()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "usuario.id, ";
        $sql .= "usuario.nombre, ";
        $sql .= "usuario.apellido_paterno, ";
        $sql .= "usuario.apellido_materno, ";
        $sql .= "usuario.mail, ";
        $sql .= "usuario.status, ";
        $sql .= "usuario.id_jefe as 'jefe'";
        $sql .= "FROM usuario ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function OhmyGod($idJefe)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "usuario.id, ";
        $sql .= "usuario.nombre, ";
        $sql .= "usuario.apellido_paterno, ";
        $sql .= "usuario.apellido_materno ";
        $sql .= "FROM usuario ";
        $sql.= "WHERE id = " . $idJefe;
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function EditarUsuario($nombre, $paterno, $materno, $email, $area, $cargo, $pais, $jefe, $status, $idUser, $id)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "UPDATE usuario SET ";
        $sql .= "nombre            = '" . $nombre."', ";
        $sql .= "apellido_paterno  = '" . $paterno."', ";
        $sql .= "apellido_materno  = '" . $materno."', ";
        $sql .= "mail              = '" . $email."', ";
        $sql .= "id_area           = '" . $area."', ";
        $sql .= "id_cargo          = '" . $cargo."', ";
        $sql .= "id_pais           = '" . $pais."', ";
        $sql .= "id_jefe           = '" . $jefe."', ";
        $sql .= "status            = '" . $status."', ";
        $sql .= "id_alterador      = '" . $idUser."', ";
        $sql .= "fecha_alt         = NOW() ";
        $sql .= "WHERE id          = '" . $id."'";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $bGravou = $stmt->rowCount();
        
        if($bGravou == 1)
        {
            $Logado = true;
        }
        else
        {
            $Logado = false;
        }
        
        return $Logado;
    }
    
}
?>