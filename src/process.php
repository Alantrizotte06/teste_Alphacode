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

if (isset($_POST['cadastrar'])) {
  $nome = $_POST['nome'];
  $data_nascimento = $_POST['data_nascimento'];
  $email = $_POST['email'];
  $profissao = $_POST['profissao'];
  $telefone = $_POST['telefone'];
  $celular = $_POST['celular'];

  $sql = "INSERT INTO dados (nome, data_nascimento, email, profissao, telefone, celular) VALUES ('$nome', '$data_nascimento', '$email', '$profissao','$telefone', '$celular')";
  
  if ($conn->query($sql) === TRUE) {
      echo "Dados inseridos com sucesso!";
  } else {
      echo "Erro: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
header("Location: index.php");
exit();
?>