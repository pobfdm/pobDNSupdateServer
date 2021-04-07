<?php
    include_once("./sauth.php");
    $login = new Login();
    $login->loginError='<p align="center" style="color: red">You are not a valid user!</p>';
    $login->LoginSession(true, true);
    
    chdir('../');
    include_once("./spdo.php");

    if (isset($_POST["save_btn"]))
    {
        $hostname=$_POST["hostname"];
        $user=$_POST["user"];
        $password=md5($_POST["password"]);
        $account_id=$_SESSION['pobdns_auth_userid'];
        
        $sql="Insert into hosts (hostname,user,password,account_id) values
                ('$hostname', '$user','$password',$account_id)";
        
        $mydb = new sPDO();
        $mydb->connect();
        $mydb->execute($sql) ;
        $mydb->disconnect();
        header('Location: index.php');
    
    }
    
    
    
   

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
        $(document).ready(function(){
            $('#repassword').keyup(function() {
                var pass = $('input[name=password]').val();
                var repass = $('input[name=repassword]').val();
                if(($('input[name=password]').val().length == 0) || ($('input[name=repassword]').val().length == 0)){
                    $("#save_btn").attr("disabled", true);
                }
                else if (pass != repass) {
                    $('#passwordHelp').addClass('text-reset text-danger');
                    $('#passwordHelp').html('passwords must be the same');
                    $("#save_btn").attr("disabled", true);
                }
                else {
                    $('#passwordHelp').addClass('text-reset text-success');
                    $('#passwordHelp').html('passwords are ok');
                    $("#save_btn").removeAttr('disabled');
                    
                }
            });
        
        }); //document ready
        
	</script>
	
</head>

<body>
<div class="container" >
   <nav class="navbar navbar-light" style="background-color: rgb(9,15,92);">
    <ul class="nav ">
        <li class="nav-item"><a class="nav-link active" href="index.php"><img class="img-fluid" style="width:25px" src="img/menu.png">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="logout.php">Logout</a></li>
    </ul>
</nav>
<div class="container" style="text-aligh: left; margin-top: 10px" >
    <h2> Add a new hostname</h2>
</div>
<form method="post" action="add-host.php">
  <div class="form-group">
    <label for="hostname">Hostname</label>
    <input type="text" class="form-control" id="hostname" name="hostname" aria-describedby="hostname" placeholder="hostname" value="">
    <small id="hostnameHelp" class="form-text text-muted">Your hostname.</small>
  </div>
  <div class="form-group">
    <label for="user">User</label>
    <input type="text" class="form-control" id="user" name="user" aria-describedby="user" placeholder="user" value="">
    <input type="hidden" name="id" value="">
    <small id="userHelp" class="form-text text-muted">Your username.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
  </div>
  <div class="form-group">
    <label for="repassword">Re type Password</label>
    <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Password" value="">
    <small id="passwordHelp" class="form-text text-muted">Retype password.</small>
  </div>
  
  
  <button type="submit" class="btn btn-primary" name="save_btn" id="save_btn" disabled>Save</button>
</form>

</div><!-- Main container -->

</body>

</html>
