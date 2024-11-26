<?php
$host = "localhost"; //O host é host padrão phpMyAdmin "localhost
$db_user = "root"; // Por padrão no xamp é palavra "root"
$db_pass = ""; // pass por padão não tem senha
$db_name = "cadastro_admin"; // nome do banco de dados que criamos no phpMyAdmin

//uma função que faz vinculo com bando de dados que criamos no mysqli_connect
$connect = mysqli_connect($host, $db_user, $db_pass, $db_name);

function login($connect)
{
    if (isset($_POST['acessar']) and !empty($_POST['email']) and !empty($_POST['senha'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    }
    $senha = sha1($_POST['senha']);

    $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha= '$senha' ";

    $executar = mysqli_query($connect, $query);

    $returna = mysqli_fetch_assoc($executar);

    if (!empty($returna['email'])) {
        // echo "Bem vindo" . $returna ['nome'];
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $returna['nome'];
        $_SESSION['ativa'] = true;


        header("location: login/index.php");
    } else {
        echo "Usuario ou senha não encontrados!";
    }
}





// <input type="submit" name="btn-enviar" value="ENVIAR.">

function novosusurios($connect){
    if (isset($_POST['enviar']) and !empty($_POST['email']) and !empty($_POST['senha'])) {
        $erros = array();

        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $senha = sha1($_POST['senha']);


        $queryemail = "SELECT email FROM usuarios WHERE email = '$email'";
        $buscaremail = mysqli_query($connect, $queryemail);
        $verificar = mysqli_num_rows($buscaremail);

        if (!empty($verificaremail)) {
            $erro[] = "E-mail já cadastrado";
        }

        if (empty($erros)) {
            //Inserir o usuario no banco de dados
            $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            $executar = mysqli_query($connect, $query);

            if ($executar) {
                echo "Cadastrado com sucesso!";
            } else {
                echo "Erro ao inserir os dados";
            }
        } else {
            foreach ($erros as $erro) {
                echo "$erros";
            }
        }
    }
}

//↓↓↓↓↓↓↓↓↓ Ira trazer mais de um resultado ↓↓↓↓↓↓↓↓↓↓
function buscar($connect, $tabela, $where = 1, $order = "") {
    if (!empty($order)) {
        $order = "ORDER BY $order";
    }
    $query = "SELECT * FROM $tabela WHERE $where $order";
    
    // Output the query for debugging
    // echo "SQL Query: " . $query . "<br>";
    
    $execute = mysqli_query($connect, $query); // Execute the query

    // Check for query errors
    if (!$execute) {
        die('Query Error: ' . mysqli_error($connect));
    }
    
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC); // Fetch all results
    return $results;
}

function buscaUnica($connect, $tabela, $id) {
    $query = "SELECT * FROM $tabela WHERE id = $id";
    $execute = mysqli_query($connect, $query);

    if (!$execute) {
        die('Query Error: ' . mysqli_error($connect));
    }

    $result = mysqli_fetch_assoc($execute);
    return $result;
}


//↓↓↓↓↓↓↓↓↓↓ Inserir novos usuarios(area adm) ↓↓↓↓↓↓↓↓↓↓↓
function novos_usuarios($connect)
{
    if ((isset($_POST['cadastrar']) and !empty($_POST['email']) and !empty($_POST['senha']))) {
        $erros = array();
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']); // ira remover os caracteres especiaias da string // serve como filter_input
        $senha = sha1($_POST['senha']);

        if ($_POST['senha'] != $_POST['repetir_senha']) {
            $erros[] = "Senha não coferem";
        }

        $query_email = "SELECT email FROM usuarios WHERE email ='$email'";
        $busca_email = mysqli_query($connect, $query_email);
        $verifica_email = mysqli_num_rows($busca_email);
        if (!empty($verifica_email)) {
            $erros[] = "Email ja cadastrado";
        }

        if (isset($_FILES["imagem"]) && !empty($_FILES["imagem"])) {
            $imagem = "./ATIVIDADE_FINAL.2.0" . $_FILES["imagem"]["name"];
            move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
        } else {
            $imagem = "";
        }

        

        if (empty($erros)) {
            //inserir usuario no bd
            $query = "INSERT INTO usuarios (nome, email, senha, imagem) VALUES ('$nome','$email','$senha', '$imagem')";
            $executar = mysqli_query($connect, $query);
            if ($executar) {
                echo "Usuario cadastrado dom sucesso!";
            } else {
                echo "erro ao cadastrar usuario";
            }
        } else {
            foreach ($erros as $erro) {
                echo $erro;
            }
        }
    }
}

//↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓Deletar/Dados↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
function deletar($connect, $tabela, $id)
{
    if (!empty($id)) {
    }
    $query = "DELETE FROM $tabela WHERE id =" . (int) $id; //where = quando-onde
    $execute = mysqli_query($connect, $query);
    if ($execute) {
        echo "Dado deletado com sucesso";
    } else {
        echo "Falha ao deletar";
    }
}



$tabela = "usuarios";
$id = 'id';
$order = 'nome';
$usuarios = buscar($connect, $tabela, $id, $where = 1, $order = " ");
?>

<!-- ↓↓↓ funções ↓↓↓ -->
<?php novos_usuarios($connect);  ?>



<!-- ↓↓↓ Verifica o valor enviado pelo botao excluir ↓↓↓ -->
<?php if (isset($_GET['id'])) { ?>
    <h2> Tem certeza que deseja deletar o usuario <?php echo $_GET['nome']; ?> </h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"> <!--tapy = hidden deixaria invisivel o campo(input) com nome e id -->
        <input type="submit" name="deletar" value="Excluir">
    </form>
<?php } ?>

<?php
if (isset($_POST['deletar'])) {     //$_POSt = name
    deletar($connect, $tabela, $_POST['id']);
    //deletar($connect, $tabela, $_POST['id']);
}

if (isset($_POST['DELETAR'])) {
    if ($_SESSION['name'] != $_POST['name']) {
        deletar($connect, "usuarios", $_POST['name']);
    } else {
        echo "Não podemos deletar conta online!!";
    }
}


//------------------------Função update --------------------
function editar($connect) {
    if (isset($_POST['atualizar']) && !empty($_POST['email'])) {
        $erros = array();
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $senha = !empty($_POST['senha']) ? sha1($_POST['senha']) : null;
        $repetir_senha = !empty($_POST['repetir_senha']) ? sha1($_POST['repetir_senha']) : null;

        if (strlen($nome) < 4) {
            $erros[] = "Preencha seu nome completo";
        }
        if (empty($email)) {
            $erros[] = "Preencha seu e-mail corretamente";
        }
        if ($senha && $senha !== $repetir_senha) {
            $erros[] = "Senhas não conferem";
        }

        $query_email_atual = "SELECT email FROM usuarios WHERE id = $id";
        $busca_email_atual = mysqli_query($connect, $query_email_atual);
        $retorno_email = mysqli_fetch_assoc($busca_email_atual);

        $query_email = "SELECT email FROM usuarios WHERE email = '$email' AND email <> '" . $retorno_email['email'] . "'";
        $busca_email = mysqli_query($connect, $query_email);
        $verifica = mysqli_num_rows($busca_email);

        if (!empty($verifica)) {
            $erros[] = "E-mail já cadastrado";
        }


        if (isset($_FILES["imagem"]) && !empty($_FILES["imagem"])) {
            $imagem = "../ATIVIDADE_FINAL.2.0/img" . $_FILES["imagem"]["name"];
            move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
        } else {
            $imagem = "";
        }

        if (empty($erros)) {
            $query = "UPDATE usuarios SET nome = '$nome', email = '$email', imagem = '$imagem'";
            if ($senha) {
                $query .= ", senha = '$senha'";
            }
            $query .= " WHERE id = " . (int)$id;

            $executar = mysqli_query($connect, $query);
            if ($executar) {
                echo "Usuário atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar o usuário: " . mysqli_error($connect);
            }
        } else {
            foreach ($erros as $erro) {
                echo "<p>$erro</p>";
            }
        }
    }
}