<?php
    include_once("./sauth.php");
    $login = new Login();
    $login->loginError='<p align="center" style="color: red">You are not a valid user!</p>';
    $login->LoginSession(true, true);
    
    chdir('../');
    include_once("./spdo.php");

    if (isset($_POST["save_btn"]))
    {
        $id=$_POST["id"];
        $hostname=$_POST["hostname"];
        $ip=$_POST["ip"];
        $user=$_POST["user"];
        $password=md5($_POST["password"]);
        $account_id=$_SESSION['pobdns_auth_userid'];
        
        if (isset($_POST['password']))
        {
            $sql="update hosts set 
                            hostname = '$hostname',
                            ip='$ip',
                            user= '$user',
                            password= '$password',
                            account_id= $account_id
                            where id=$id ;
                            ";
        }else{
            $sql="update hosts set 
                            hostname = '$hostname',
                            ip='$ip',
                            user= '$user',
                            account_id= $account_id 
                            where id= $id ;
                            ";
        
        }
        $mydb = new sPDO();
        $mydb->connect();
        $mydb->execute($sql) ;
        $mydb->disconnect();
        
        header('Location: index.php');
    
    }else{
        $id=$_GET["id"];
    }
    
    
    
    $mydb = new sPDO();
    $mydb->connect();
    $sql="select *  from hosts where id=$id ;" ;
    $mydb->execute($sql) ;
    
    $hostname=$mydb->read(1,'hostname');
    $ip=$mydb->read(1,'ip');
    $user=$mydb->read(1,'user');
    $password=$mydb->read(1,'password');
    

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>PobDNSupdate</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<script src="./js/jquery.min.js"></script>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="./js/bootstrap.bundle.min.js"></script>
	<script>
        function confirmDel()
        {
            var r = confirm("Delete this host?");
            if (r == true) {
                window.location.href = 'delete-host.php?id=<?php echo $id ;?>';
            } 
        }
        
	</script>
</head>

<body>
<div class="container" >
   <nav class="navbar navbar-light" style="background-color: rgb(9,15,92);">
    <ul class="nav ">
        <li class="nav-item"><a class="nav-link active" href="index.php"><img class="img-fluid" style="width:25px" src="img/menu.png">Home</a></li>
        <li class="nav-item"><button onclick="confirmDel()" type="button" class="btn btn-danger">Delete host</button></li>
        <li class="nav-item"><a class="nav-link active" href="logout.php">Logout</a></li>
    </ul>
</nav>
<form method="post" action="edit-host.php">
  <div class="form-group">
    <label for="hostname">Hostname</label>
    <input type="text" class="form-control" id="hostname" name="hostname" aria-describedby="hostname" placeholder="hostname" value="<?php echo $hostname ?>">
    <small id="hostnameHelp" class="form-text text-muted">Your hostname.</small>
  </div>
  <div class="form-group">
    <label for="ip">Last ip</label>
    <input type="text" class="form-control" id="ip" name="ip" aria-describedby="ip" placeholder="last ip" value="<?php echo $ip ?>">
    <small id="ipHelp" class="form-text text-muted">Last ip updated.</small>
  </div>
  <div class="form-group">
    <label for="user">User</label>
    <input type="text" class="form-control" id="user" name="user" aria-describedby="user" placeholder="user" value="<?php echo $user ?>">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <small id="userHelp" class="form-text text-muted">Your username.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password ?>">
  </div>
  
  <button type="submit" class="btn btn-primary" name="save_btn" id="save_btn" >Save</button>
</form>

</div><!-- Main container -->

</body>

</html>
