<?php
  // Inicia a sessão
session_start();
    // Checka se o usuario já está logado
  if (isset($_SESSION['user'])){
      // Se tiver redireciona para o index
    header("location:index.php");
  }
include 'header.php';
include 'db_connect.php';

if (isset($_POST['inputUsername'])) {
    //Pega Dados enviado pelo Formulario de Login
  $usuario = mysqli_real_escape_string($conn, $_POST['inputUsername']); //Proteger contra SQL
  $senha = mysqli_real_escape_string($conn, $_POST['inputPassword']); //Proteger contra SQL

  //Vamos execulta um comando
  $result_usuario = "SELECT * FROM usuarios WHERE username = '$usuario' AND password = '$senha' LIMIT 1";
  $resultado_usuario = mysqli_query($conn, $result_usuario);
  $resultado = mysqli_fetch_assoc($resultado_usuario);

  $status = "";

  if (isset($resultado)) {
    $_SESSION['id'] = $resultado['id'];
    $_SESSION['username'] = $resultado['username'];
    $_SESSION['password'] = $resultado['password'];

      $status = "<div class='alert alert-success alert-dismissable fade in'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong>Sucesso!</strong> Redirecionando...
                </div>";
    header( "refresh:3;url=index.php");

    } else {
      $status = "<div class='alert alert-danger alert-dismissable fade in'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong>Falha!</strong> Tente novamente.
                </div>";
  }
}
?>

<div class="container login">
  <form class="form-login" method="POST" action="">
    <h2 class="titulo-login"><span class="foco-titulo-web">Web</span>Service <span class="foco-titulo-ssh">SSH</span></h2><br />
    <?php
      if (isset($status)) {
        echo $status;
      }
     ?>
    <label for="inputUsername" class="sr-only">Usuário</label>
    <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Usuário" required autofocus>
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Senha" required>
    <div class="form-group">
      <button class="btn btn-lg btn-block" type="submit">Entrar</button>
    </div>
  </form>
</div> <!-- /container -->

<?php include 'footer.php'; ?>
