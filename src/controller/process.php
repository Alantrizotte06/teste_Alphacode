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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $email = $_POST['email'] ?? '';
    $profissao = $_POST['profissao'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $celular = $_POST['celular'] ?? '';

    if ($id) {
        $sql = "UPDATE dados SET nome='$nome', data_nascimento='$data_nascimento', email='$email', profissao='$profissao', telefone='$telefone', celular='$celular' WHERE id=$id";
    } else {
        $sql = "INSERT INTO dados (nome, data_nascimento, email, profissao, telefone, celular) VALUES ('$nome', '$data_nascimento', '$email', '$profissao', '$telefone', '$celular')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Dados salvos com sucesso!";
        header("Location: ../view/index.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    exit();
} else {
    echo "Método de requisição inválido.";
}
?>