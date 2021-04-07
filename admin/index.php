<?php
    include_once("./sauth.php");
    $login = new Login();
    $login->loginError='<p align="center" style="color: red">You are not a valid user!</p>';
    $login->LoginSession(true, true);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>PobDNSupdate</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="60;url=index.php">


	<script src="./js/jquery.min.js"></script>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="./js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container" >
   <nav class="navbar navbar-light" style="background-color: rgb(9,15,92);">
    <ul class="nav">
        <li class="nav-item"><a class="nav-link active" href="index.php"><img class="img-fluid" style="width:25px" src="img/menu.png">Home</a></li>
        <li class="nav-item"><button onclick="window.location.href = 'add-host.php'" type="button" class="btn btn-primary green">Add new host</button></li>
        <li class="nav-item"><a class="nav-link active" href="logout.php">Logout</a></li>
    </ul>
</nav>

<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Host</th>
      <th scope="col">IP</th>
      <th scope="col">Last updated</th>
    </tr>
  </thead>
  <tbody>
    <?php
        chdir('../');
        include_once("./spdo.php");
        $account_id=$_SESSION['pobdns_auth_userid'];

        $mydb = new sPDO();
        $mydb->connect();
        $sql="select *  from hosts where account_id=$account_id;" ;
        $mydb->execute($sql) ;
        
        for ($i=1; $i<= $mydb->nrows(); $i++)
        {
            $id=$mydb->read($i,'id');
            $hostname=$mydb->read($i,'hostname');
            $ip=$mydb->read($i,'ip');
            $lastupdate=$mydb->read($i,'lastupdate');
            
            echo  "
            <tr  onmouseenter=\"$(this).css('cursor','pointer')\" onmouseleave=\"$(this).css('cursor','default')\" onclick=\"window.location.href = 'edit-host.php?id=$id'\">
            <th scope=\"row\">$id</th>
            <td>$hostname</td>
            <td>$ip</td>
            <td>$lastupdate</td>
            </tr>
            ";
        }
        
    ?>
    
  </tbody>
</table>

</div><!-- Main container -->

</body>

</html>
