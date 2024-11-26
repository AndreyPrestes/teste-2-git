<?php
session_start();
require_once "login/functions.php"; // Certifique-se de incluir o arquivo com a função de conexão e outras funções necessárias

// Verifica se foi submetido um formulário com o ID do usuário a ser buscado
if(isset($_POST['buscar'])) {
    // Conecta ao banco de dados (substitua pelos seus dados de conexão)
    $host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "cadastro_admin";

    $connect = mysqli_connect($host, $db_user, $db_pass, $db_name);

    // Verifica se a conexão foi estabelecida corretamente
    if (!$connect) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Obtém o ID do usuário do formulário
    $id = mysqli_real_escape_string($connect, $_POST['id']);

    // Query para buscar os dados do usuário pelo ID
    $query = "SELECT * FROM usuarios WHERE id = '$id'";
    $result = mysqli_query($connect, $query);

    // Verifica se encontrou algum resultado
    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
    } else {
        $mensagem = "Nenhum usuário encontrado com o ID $id";
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Buscar Usuário por ID</title>
</head>

<body>
    <h1>Buscar Usuário por ID</h1>

    <form action="" method="post">
        <label for="id">ID do Usuário:</label>
        <input type="text" id="id" name="id">
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php if(isset($usuario)): ?>
        <h2>Dados do Usuário Encontrado:</h2>
        <p>ID: <?php echo $usuario['id']; ?></p>
        <p>Nome: <?php echo $usuario['nome']; ?></p>
        <p>E-mail: <?php echo $usuario['email']; ?></p>
        <!-- Adicione outros campos conforme necessário -->
    <?php elseif(isset($mensagem)): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <br>
    <a href="home.php">Voltar para a Página Inicial</a>

</body>

</html>
