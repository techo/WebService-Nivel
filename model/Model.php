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
        $sql .= "usuario.id_netsuite as 'id_netsuite' , ";
        $sql .= "usuario.status as 'status' , ";
        $sql .= "cargo.nombre as 'cargo', ";
        $sql .= "cargo.id as 'idcargo', ";
        $sql .= "cargo.codigo as 'codcargo', ";
        $sql .= "pais.nombre  as 'pais', ";
        $sql .= "pais.codigo  as 'codigoPais', ";
        $sql .= "pais.id  as 'codpais' ";
        $sql .= "FROM usuario ";
        $sql .= "LEFT JOIN cargo ON cargo.id = usuario.id_cargo ";
        $sql .= "LEFT JOIN pais ON pais.id = usuario.id_pais ";
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
        $sql .= "usuario.id_netsuite as 'id_netsuite', ";
        $sql .= "usuario.mail, ";
        $sql .= "cargo.nombre as 'cargo'";   
        $sql .= "FROM usuario ";
        $sql .= "LEFT JOIN cargo ON cargo.id = usuario.id_cargo ";
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
        $sql .= "usuario.id_netsuite as 'id_netsuite', ";
        $sql .= "cargo.nombre as 'cargo'";
        $sql .= "FROM pais ";
        $sql .= "LEFT JOIN usuario ON usuario.id = pais.id_aff ";
        $sql .= "LEFT JOIN cargo ON cargo.id = usuario.id_cargo ";
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
    
    function GrabarUsuario($nombre, $paterno, $materno, $email, $password, $cargo, $pais, $jefe, $status, $idUser, $netsuite)
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
        $sql .= "id_cargo, ";
        $sql .= "id_pais, ";
        $sql .= "id_jefe, ";
        $sql .= "id_netsuite, ";
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
        $sql .= "'". $cargo."', ";
        $sql .= "'". $pais."', ";
        $sql .= "'". $jefe."', ";
        $sql .= "'". $netsuite."', ";
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
    
    function GrabarCargo($nombre, $codigo, $status, $idUser)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "INSERT INTO cargo (";
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
    
    function GrabarRegion($nombre, $codigo, $status, $idPais, $idUser)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "INSERT INTO region (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "status, ";
        $sql .= "id_pais, ";
        $sql .= "id_criador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $nombre."', ";
        $sql .= "'". $codigo."', ";
        $sql .= "'". $status."', ";
        $sql .= "'". $idPais."', ";
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
        $sql .= "codigo, ";
        $sql .= "status ";
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
    
    function ListRegion()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "nombre ";
        $sql .= "FROM region ";
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
        $sql .= "usuario.id_netsuite as id_netsuite, ";
        $sql .= "usuario.status, ";
        $sql .= "usuario.id_jefe as 'jefe' ";
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
    
    function EditarUsuario($nombre, $paterno, $materno, $email, $cargo, $pais, $jefe, $status, $idUser, $id, $netsuite)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "UPDATE usuario SET ";
        $sql .= "nombre            = '" . $nombre."', ";
        $sql .= "apellido_paterno  = '" . $paterno."', ";
        $sql .= "apellido_materno  = '" . $materno."', ";
        $sql .= "mail              = '" . $email."', ";
        $sql .= "id_cargo          = '" . $cargo."', ";
        $sql .= "id_pais           = '" . $pais."', ";
        $sql .= "id_jefe           = '" . $jefe."', ";
        $sql .= "id_netsuite       = '" . $netsuite."', ";
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
    
    function InfoArea($id)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "status ";
        $sql .= "FROM area ";
        $sql.= "WHERE id = " . $id;
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function ListaArea()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "status ";
        $sql .= "FROM area ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function EditarArea($nombre, $codigo, $status, $idUser, $id)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "UPDATE area SET ";
        $sql .= "nombre            = '" . $nombre."', ";
        $sql .= "codigo            = '" . $codigo."', ";
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
    
    function ListaCargo()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "status ";
        $sql .= "FROM cargo ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function InfoCargo($id)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "status ";
        $sql .= "FROM cargo ";
        $sql.= "WHERE id = " . $id;
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function EditarCargo($nombre, $codigo, $status, $idUser, $id)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "UPDATE cargo SET ";
        $sql .= "nombre            = '" . $nombre."', ";
        $sql .= "codigo            = '" . $codigo."', ";
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
    
    function ListaPais()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "pais.id as 'id', ";
        $sql .= "pais.nombre as 'nombre',  ";
        $sql .= "pais.codigo as 'codigo', ";
        $sql .= "aff.id as 'id_aff', ";
        $sql .= "aff.nombre as 'nombre_aff', ";
        $sql .= "aff.apellido_paterno as 'paterno_aff', ";
        $sql .= "aff.apellido_materno as 'materno_aff', ";
        $sql .= "cont.id as 'id_cont', ";
        $sql .= "cont.nombre as 'nombre_cont', ";
        $sql .= "cont.apellido_paterno as 'paterno_cont', ";
        $sql .= "cont.apellido_materno as 'materno_cont', ";
        $sql .= "pais.status as 'status'";
        $sql .= "FROM pais ";
        $sql .= "INNER JOIN usuario aff ON pais.id_aff = aff.id ";
        $sql .= "INNER JOIN usuario cont ON pais.id_cont = cont.id";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function ListaRegion()
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "region.id as 'id', ";
        $sql .= "pais.nombre as 'nombre_pais',  ";
        $sql .= "region.nombre as 'nombre',  ";
        $sql .= "region.codigo as 'codigo',  ";
        $sql .= "region.id_pais as 'id_pais',  ";
        $sql .= "region.status as 'status'";
        $sql .= "FROM region ";
        $sql .= "INNER JOIN pais pais ON pais.id = region.id_pais ";
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function InfoPais($id)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "pais.id as 'id', ";
        $sql .= "pais.nombre as 'nombre',  ";
        $sql .= "pais.codigo as 'codigo', ";
        $sql .= "aff.id as 'id_aff', ";
        $sql .= "aff.nombre as 'nombre_aff', ";
        $sql .= "aff.apellido_paterno as 'paterno_aff', ";
        $sql .= "aff.apellido_materno as 'materno_aff', ";
        $sql .= "cont.id as 'id_cont', ";
        $sql .= "cont.nombre as 'nombre_cont', ";
        $sql .= "cont.apellido_paterno as 'paterno_cont', ";
        $sql .= "cont.apellido_materno as 'materno_cont', ";
        $sql .= "pais.status as 'status'";
        $sql .= "FROM pais ";
        $sql .= "INNER JOIN usuario aff ON pais.id_aff = aff.id ";
        $sql .= "INNER JOIN usuario cont ON pais.id_cont = cont.id ";
        $sql .= "WHERE pais.id =  " . $id;
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function InfoRegion($id)
    {
        require_once 'DBConfig.php';
        $sql  = "SELECT ";
        $sql .= "region.id as 'id', ";
        $sql .= "region.nombre as 'nombre',  ";
        $sql .= "region.codigo as 'codigo', ";
        $sql .= "region.id_pais as 'id_pais' ";
        $sql .= "FROM region ";
       // $sql .= "INNER JOIN usuario aff ON pais.id_aff = aff.id ";
        $sql .= "WHERE region.id =  " . $id;
        $pdo = Database::conexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function EditarPais($nombre, $codigo, $id_aff, $id_cont, $status, $idUser, $id)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "UPDATE pais SET ";
        $sql .= "nombre            = '" . $nombre."', ";
        $sql .= "codigo            = '" . $codigo."', ";
        $sql .= "id_aff            = '" . $id_aff."', ";
        $sql .= "id_cont           = '" . $id_cont."', ";
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
    
    function EditarRegion($nombre, $codigo, $id_pais, $idUser, $id)
    {
        require_once 'DBConfig.php';
        $sql  = "";
        $sql .= "UPDATE region SET ";
        $sql .= "nombre            = '" . $nombre."', ";
        $sql .= "codigo            = '" . $codigo."', ";
        $sql .= "id_pais            = '" . $id_pais."', ";
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