<?php
include 'header.php';

// session_start();
//   if (!isset($_SESSION['user'])){
//     header("location:login.php");
//   }
?>

<div class="jumbotron">
  <h1>khju</h1>
</div>
<div class="container">
  <?php
$server['ip'] = "191.96.139.161";
$server['sshport'] = 22;
$server['user'] = "root";
$server['password'] = "nossa123*";

$command = "uname -a";

if($ssh = ssh2_connect($server['ip'], $server['sshport'])) {

  if($ssh_auth_password($ssh, $server['user'], $server['password'])) {

$stream = ssh2_exec($ssh, $command);

stream_set_blocking($stream, true);

$data = '';

while($buffer = fread($stream, 4096))

{
 $data .= $buffer;

}

fclose($stream);
echo $data;

}else {
  echo "Falhou: usuario ou senha incorretos!";
}

}else {
  echo "Falhou: ip ou porta incorretos!";
}

?>
</div>

<?php include 'footer.php'; ?>
