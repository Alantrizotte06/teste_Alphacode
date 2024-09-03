<?php 
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "cadastro_alphacode";

// Cria a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se um ID foi passado para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM dados WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Registro não encontrado.";
        exit();
    }
}

// Verifica se o formulário foi enviado
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $email = $_POST['email'] ?? '';
    $profissao = $_POST['profissao'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $celular = $_POST['celular'] ?? '';

    // Atualiza os dados
    $sql = "UPDATE dados SET nome='$nome', data_nascimento='$data_nascimento', email='$email', profissao='$profissao', telefone='$telefone', celular='$celular' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Dados alterados com sucesso!";
        header("Location: ../view/index.php");
        exit();  // Certifique-se de sair após o redirecionamento
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/img/logo_alphacode.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/css/editar.css">
  <title>Editar Dados</title>
</head>

<body>

  <header>
    <img src="../assets/img/logo_alphacode.png" alt="">
    <h1>Editar Dados</h1>
  </header>

  <form class="formEditar" action="editar.php?id=<?php echo $id; ?>" method="POST">

    <div class="dadosEditar">
      <label for="nome">Nome</label>
      <input type="text" name="nome" class="dadosEditar" value="<?php echo $row['nome']; ?>" required>
    </div>
    <div class="dadosEditar">
      <label for="data_nascimento">Data de Nascimento</label>
      <input type="date" name="data_nascimento" class="dadosEditar" value="<?php echo $row['data_nascimento']; ?>"
        required>
    </div>
    <div class="dadosEditar">
      <label for="email">E-mail</label>
      <input type="text" name="email" class="dadosEditar" value="<?php echo $row['email']; ?>" required>
    </div>
    <div class="dadosEditar">
      <label for="profissao">Profissão</label>
      <input type="text" name="profissao" class="dadosEditar" value="<?php echo $row['profissao']; ?>" required>
    </div>
    <div class="dadosEditar">
      <label for="telefone">Telefone</label>
      <input type="text" name="telefone" class="dadosEditar" value="<?php echo $row['telefone']; ?>">
    </div>
    <div class="dadosEditar">
      <label for="celular">Celular</label>
      <input type="text" name="celular" class="dadosEditar" value="<?php echo $row['celular']; ?>">
    </div>
    <div class="btnCadastrar">
      <button type="submit" name="atualizar">Atualizar</button>
    </div>

  </form>

  <footer>
    <div>
      <p>Termos | Políticas</p>
    </div>
    <div>
      <p>©Copyright 2022 | Desenvolvido por</p>
      <img src="../assets/img/logo_rodape_alphacode.png">
    </div>
    <div>
      <p>©Alphacode IT Solutions 2022</p>
    </div>
  </footer>
</body>

</html>