<?php
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'web_service_ssh';

$connect = mysqli_connect($server, $user, $password, $db);

$query = "SELECT * FROM usuarios";
$linhas = mysqli_query($connect, $query);
for ($i=0; $i <10 ; $i++) {
  echo $linhas[$i];
}

?>
