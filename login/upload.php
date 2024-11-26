<?php require_once "functions.php";
if (isset($_FILES['imagem']) && !empty ($_FILES['imagem'])) 
{
    move_uploaded_file($_FILES["imagem"]["tmp_name"], "./ATIVIDADE_FINAL.2.0" .$_FILES["imagem"]["name"]);
    echo "update certo";
}
?>


