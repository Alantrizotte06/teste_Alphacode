<?php
session_start();

$modo = 'local'; 

//CREDENCIAIS LOCAL (XAMPP)
if($modo =='local'){
    $servidor ="localhost";
    $usuario = "root";
    $senha = "";
    $banco = "login";
}

//CONEXÃO COM BANCO DE DADOS
try{
   $pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
   //echo "Banco conectado com sucesso!"; 
}catch(PDOException $erro){
    echo "Falha ao se conectar com o banco! ";
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
?>