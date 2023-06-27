<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Adiciona o arquivo de Conexão a esta página
require_once("Connection.php");

//Conexão a ser utiliza no acesso ao banco de dados
$conn = Connection::getConnection();
//print_r($conn);

$msgErro = "";

$nome = "";
$nickname = "";
$data = "";
$email = "";
$telefone = "";
$classificacao = "";


$nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
$nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : null;
$data = isset($_POST['data']) ? $_POST['data'] : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;
$classificacao = isset($_POST['classificacao']) ? $_POST['classificacao'] : null;



if (isset($_POST['submetido'])) {
  if (!$nome) {
    $msgErro = "Informe seu nome";
  } else if (!$nickname) {
    $msgErro = "Informe seu nickname";
  } else if (!$data) {
    $msgErro = "Informe a sua data de nascimento";
  } else if (!$email) {
    $msgErro = "Informe seu email";
  } else if (!$telefone) {
    $msgErro = "Informe seu telefone";
  } else if (!$classificacao) {
    $msgErro = "Selecione uma classificação";
  } else {

    $sql = 'INSERT INTO jogadores (nome, nickname, data_nascimento, email, telefone, classficacao)' .
      ' VALUES (?, ?, ?, ? , ? , ?)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nome, $nickname, $data, $email, $telefone, $classificacao]);

    header("location: cadastro.php");
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>

  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="cadastro.css">
</head>

<body>

  <form class="form div" action="" method="POST">

    <div class="form-title"><span>Cadastrar-se para</span></div>
    <div class="title-2"><span>GAME</span></div>

    <div class="input-container">
      <input class="input" name="nome" id="nome" value="<?php echo $nome ?>" type="text" placeholder="Nome">
      <input class="input" name="nickname" id="nickname" value="<?php echo $nickname ?>" type="text" placeholder="Nickname">
      <input class="input" name="data" id="data" type="date" value="<?php echo $data ?>" placeholder="">
      <input class="input" name="email" id="email" type="email" value="<?php echo $email ?>" placeholder="Email">
      <input class="input" name="telefone" id="telefone" type="tel" value="<?php echo $telefone ?>" placeholder="Telefone">
      <select name="classificacao">

        <option value="">Selecione classificação</option>
        <option value="A" <?php echo ($classificacao == 'A' ? 'selected' : ''); ?>> Ação </option>
        <option value="Av" <?php echo ($classificacao == 'Av' ? 'selected' : ''); ?>> Aventura </option>
        <option value="R" <?php echo ($classificacao == 'R' ? 'selected' : ''); ?>> RPG </option>
        <option value="S" <?php echo ($classificacao == 'S' ? 'selected' : ''); ?>> Simulação </option>
        <option value="E" <?php echo ($classificacao == 'E' ? 'selected' : ''); ?>> Esportes </option>
        <option value="Es" <?php echo ($classificacao == 'Es' ? 'selected' : ''); ?>> Estratégia </option>
        <option value="O" <?php echo ($classificacao == 'O' ? 'selected' : ''); ?>> Outros </option>
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

    <input type="hidden" name="submetido" value="1">

  </form>

  <div id="divErro" style="color:white;">
    <?php echo $msgErro; ?>
  </div>


  <?php
  $sql = "SELECT* FROM jogadores";

  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  ?>

  <div class=" form div2">
    <div class="form-title"><span>Tabela do</span></div>
    <div class="title-2"><span>JOGADOR</span></div>
    <table class="table table-hover ">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Nickname</th>
          <th scope="col">Data</th>
          <th scope="col">Email</th>
          <th scope="col">Telefone</th>
          <th scope="col">Classificação</th>
          <th scope="col">Excluir</th>
        </tr>
      </thead>
      <?php foreach ($result as $reg) : ?>
        <tbody>
          <tr>
            <th scope="row"><?= $reg['id'] ?></th>
            <td><?= $reg['nome'] ?></td>
            <td><?= $reg['nickname'] ?></td>
            <td><?= $reg['data_nascimento'] ?></td>
            <td><?= $reg['email'] ?></td>
            <td><?= $reg['telefone'] ?></td>
            <td>
              <?php
              switch ($reg['classficacao']) {
                case 'A':
                  echo "Ação";
                  break;
                case 'Av':
                  echo "Aventura";
                  break;
                case 'R';
                  echo "RPG";
                  break;
                case 'S';
                  echo "Simulação";
                  break;
                case 'E';
                  echo "Esportes";
                  break;
                case 'Es';
                  echo "Estratégias";
                  break;
                case 'O':
                  echo "Outros";
                  break;
              }
              ?>
            </td>
            <td><a style="text-decoration:none; color:white;" href="cadastro_del.php?id=<?= $reg['id'] ?>" onclick="return confirm('Deseja excluir registro?');">Excluir</a></td>
          </tr>
        <?php endforeach; ?>
        <tbody>
    </table>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>