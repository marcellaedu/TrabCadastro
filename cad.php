<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Adiciona o arquivo de Conexão a esta página
require_once("Connection.php");

//Conexão a ser utiliza no acesso ao banco de dados
$conn = Connection::getConnection();
//print_r($conn);

if(isset($_POST['submetido'])) {
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $genero = isset($_POST['genero']) ? $_POST['genero'] : null;
    $qtdPaginas = isset($_POST['qtdPaginas']) ? 
                        $_POST['qtdPaginas'] : null;

    $sql = 'INSERT INTO livros (titulo, genero, qtd_paginas)' .
        ' VALUES (?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titulo, $genero, $qtdPaginas]);

    header("location: livros.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="cad.css">
</head>
<body>

    <form class="form div">

        <div class="form-title"><span>Cadastrar-se para</span></div>
         <div class="title-2"><span>GAME</span></div>

         <div class="input-container">
            <input class="input" name="nome" id="nome" type="text" placeholder="Nome">
            <input class="input" name="nickname" id="nickname" type="text" placeholder="Nickname">
            <input class="input" name="data" id="data" type="date" placeholder="">
            <input class="input" name="email" id="email" type="email" placeholder="Email">
            <input class="input" name="telefone" id="telefone" type="tel" placeholder="Telefone">
            <select name="classificacao">
                <option value="">Selecione classificação</option>
                <option value="A"> Ação </option>
                <option value="Av"> Aventura </option>
                <option value="R"> RPG </option>
                <option value="S"> Simulação </option>
                <option value="E"> Esportes </option>
                <option value="Es"> Estratégia </option>
                <option value="O"> Outros </option>
            </select><br><br>
         </div>
    
         <section class="bg-stars">
           <span class="star"></span>
           <span class="star"></span>
           <span class="star"></span>
           <span class="star"></span>
         </section>
    
         <button type="reset" class="reset">
            <span class="sign-text">limpar</span>
          </button>
         <button type="submit" class="submit">
           <span class="sign-text">Cadastrar</span>
         </button>
    
      </form>

      <div class="form div2">
      <div class="form-title"><span>Tabela do</span></div>
      <div class="title-2"><span>JOGADOR</span></div>
        <table border="2">
          <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Nickname</td>
            <td>Data</td>
            <td>Email</td>
            <td>Telefone</td>
            <td>Classificação</td>
          </tr>

           <?php foreach($result as $reg):?>
            <tr>
                <td><?= $reg ['id']?></td>
                <td><?= $reg ['nick']?></td>
                <td>
                <?php 
                    switch( $reg ['genero']){
                        case 'D':
                            echo "Drama";
                            break;
                        case 'F':
                            echo "Ficção";
                            break;
                        case 'R';
                            echo "Romance";
                            break;
                        case 'O':
                            echo "Outros";
                            break;
                    }
                    ?>
                </td>
                <td><?= $reg ['qtd_paginas']?></td>
                <td><?= $reg ['autor']?></td>
                <td><a style="text-decoration:none; color:brown;" href="livrosDel.php?id=<?= $reg ['id']?>" onclick="return confirm('Deseja excluir registro?');">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
          
          
          
          ?>
          
        </table>
        
      </div>
</body>
</html>