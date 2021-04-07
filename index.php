<?php
$user=$_SERVER['PHP_AUTH_USER'];
$password=md5($_SERVER['PHP_AUTH_PW']);
$hostname=$_GET['hostname'];
$lastUpdate=date("D M j G:i:s  Y");
$ip=$_SERVER['REMOTE_ADDR'];

//Only debug
/*
echo "<p>hostname: {$hostname}</p>\n";
echo "<p>user: {$user} </p>";
echo "<p>password in chiaro: {$password_clear} </p>";
echo "<p>password cifrata : {$password} </p>";
echo "<p>LastUpdate: {$lastUpdate} </p>";
*/



include_once("spdo.php");

$mydb = new sPDO();
$mydb->connect();
$sql="select *  from hosts where user = '$user' and password = '$password' and hostname='$hostname' ;" ;
$mydb->execute($sql) ;
$lastIP=$mydb->read(1,'ip');


if($mydb->nrows()<1) 
{
    print "Unauthorized !" ;
    $mydb->disconnect();
    exit();
}
$mydb->disconnect();

if ($lastIP==$ip)
{
    print("Ip not changed.");
    exit();
}


$mydb = new sPDO();
$mydb->connect();
$sql="update  'hosts' set ip='$ip',lastupdate='$lastUpdate' where hostname='$hostname' " ;
$mydb->execute($sql);
$mydb->disconnect();
print("Ip updated.");

$mydb = new sPDO();
$mydb->connect();
$sql="select *  from hosts ;" ;
$mydb->execute($sql) ;


$fp = fopen('hosts', 'w');
for ($i=1; $i<= $mydb->nrows(); $i++)
{
    if (!empty($mydb->read($i,'ip')) && !empty($mydb->read($i,'hostname')) )
    {
        $data = $mydb->read($i,'ip').'   '.$mydb->read($i,'hostname').PHP_EOL;
        fwrite($fp, $data);
    }   
}
fclose($fp);


?>
