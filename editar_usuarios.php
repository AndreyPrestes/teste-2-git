<?php 
session_start(); 
require_once "login/functions.php"; 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <!-- link das fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Krona+One&display=swap" rel="stylesheet">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- width=device-width: Define a largura da viewport como igual à largura do dispositivo.
        initial-scale=1.0: Define o nível de escala inicial da viewport como 1.0. Isso significa que a página será exibida sem nenhum zoom inicial. 
      Ajuda a garantir que o layout da sua página seja responsivo em dispositivos móveis. 
    -->
   <!-- links para as paginas CSS  -->
   <link rel="stylesheet" href="aboutus.css" type="text/css">
   <link rel="stylesheet" href="body_header_footer.css" type="text/css">

   <title>Painel Administrador</title>
</head>

<body>
   <h1>Painel Administrador editar Usuário</h1>
   <h3>Seja bem vindo! <?php echo $_SESSION['nome']; ?></h3>
   
<?php
   $tabela = "usuarios";
   $id = 'id';
   $order = 'nome';
   $usuarios = buscar($connect, $tabela, $id, $where = 1, $order = " ");
?>
   
   <?php
   if (isset($_GET['id'])) { 
      $id = $_GET['id'];
		$usuario = buscaUnica($connect, 'usuarios', $id);
      editar($connect);
   ?>
      <h2>Editando o usuário <?php echo $_GET['nome']; ?></h2>

   <?php } ?>

   <form action="" method="post">
      <fieldset>
         <legend>Editar Usuario</legend>
         <input value ="<?php echo $usuario['id']; ?>" type="hidden" name="id" required>
         <img src="../ATIVIDADE_FINAL.2.0/img"<?php echo $usuario["imagem"];?>" width="75" height="75"></td>
         <input value ="<?php echo $usuario['nome']; ?>" type="text" name="nome" placeholder="nome" required>
         <input value ="<?php echo $usuario['email']; ?>"type="email" name="email" placeholder="E-MAIL" required>
         <input type="password" name="senha" placeholder="senha">
         <input type="password" name="repetir_senha" placeholder="Confirmar senha">
         <input value="<?php echo $usuario['imagem'];?>" type="file" name="imagem" accept="ATIVIDADE_FINAL.2.0/*">
         <input type="submit" name="atualizar" value="Atualizar">
      </fieldset>
   </form>
   <br>
   <a class="bt voltar" href="login/index.php"> Voltar </a>
   <br><br><br>
   <a class="bt sair" href="home.php"> Sair </a>

</body>
</html>

