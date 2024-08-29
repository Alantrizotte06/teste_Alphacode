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

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql= "DELETE FROM dados WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
      echo "Dados deletados com sucesso!";
      header("Location: ../view/index.php");
  } else {
      echo "Erro: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
exit();
?>