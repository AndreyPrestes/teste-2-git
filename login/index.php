<?php session_start();
 require_once "functions.php";
 require_once "/xampp/htdocs/ATIVIDADE_FINAL.2.0/layout/index.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
   <!-- link das fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Krona+One&display=swap" rel="stylesheet">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
   <!-- links para as paginas CSS  -->
   <link rel="stylesheet" href="../css/index.css" type="text/css">
   
   <title></title>
</head>
<body> 
<?php if ( isset($_SESSION['ativa']) ) { ?>

<a class="bt sair" href="sair.php"> Sair </a>
	<?php } else {
		echo "<h2>
				<a href='index.php'> Voltar </a></h2>";
	} ?>
<!-- <a href="contactus.php">Sair</a> -->



</body>

</html>