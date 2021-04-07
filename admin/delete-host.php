<?php
    include_once("./sauth.php");
    $login = new Login();
    $login->loginError='<p align="center" style="color: red">You are not a valid user!</p>';
    $login->LoginSession(true, true);
    chdir('../');
    include_once("./spdo.php");
    
    $id=$_GET['id'];
    if (isset($_GET["id"]))
    {
        $sql="delete from hosts where id= $id ";
        $mydb = new sPDO();
        $mydb->connect();
        $mydb->execute($sql) ;
        $mydb->disconnect();
    }
    
    
    
    header('Location: index.php')
?>    
