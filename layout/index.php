<section class="main-cadastro">   
   <h1>Painel Administrador</h1>
   <h3>Seja bem vindo! <?php echo $_SESSION['nome']; ?></h3>
   


<form class="inserir" action="index.php" method="post" enctype="multipart/form-data">
      <fieldset>
         <legend>Inserir Usuarios</legend>
         <input type="text" name="nome" placeholder="nome">
         <input type="email" name="email" placeholder="E-MAIL">
         <input type="password" name="senha" placeholder="senha">
         <input type="password" name="repetir_senha" placeholder="Confirmar senha">
         <input type="file" name="imagem" accept="image/*">
         <input type="submit" name="cadastrar" value="cadastrar">
         



      </fieldset>
   </form>

   <section class="tabela">
   <table>
      <thead>
         <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>E-MAIL</th>
            <th>IMAGEM</th>
            <TH></TH>
            
         </tr>
      <tbody>
         <?php foreach ($usuarios as $usuario) { ?>
            <tr>
               <td><?php echo $usuario['id']; ?></td>
               <td><?php echo $usuario['nome']; ?></td>
               <td><?php echo $usuario['email']; ?></td>
               <td><img src="<?php echo $usuario["imagem"];?>" width="75" height="75"></td>
               <td>
                  <a href="index.php?id=<?php echo $usuario['id']; ?>&nome=
                  <?php echo $usuario['nome']; ?>">Excluir</a>
                  
               </td>
               <td>
                    <a href="../editar_usuarios.php?id=<?php echo ($usuario['id']); ?>&nome=<?php echo ($usuario['nome']); ?>">Editar</a>
                </td>
         <?php
         }
         ?>
      </tbody>
   </table>
   </section>
</section>
