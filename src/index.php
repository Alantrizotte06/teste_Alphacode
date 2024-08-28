<!DOCTYPE html>
<html lang="pt-Br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/logo_alphacode.png" type="image/x-icon">

  <link rel="stylesheet" href="./assets/css/global.css">
  <title>Cadastro de Contatos</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
</head>

<body>
  <header>
    <img src="./assets/logo_alphacode.png">
    <h1>Cadastro de Contatos</h1>
  </header>

  <form action="process.php" class="formCadastro" method="POST">
    <div class="dadosCadastro">
      <label for="nome">Nome completo</label>
      <input type="text" name="nome" placeholder="Ex.: Letícia Pacheco dos Santos" required>
    </div>

    <div class="dadosCadastro">
      <label for="data_nascimento">Data de nascimento</label>
      <input type="date" name="data_nascimento" placeholder="Ex.: 03/10/2003" required>
    </div>

    <div class="dadosCadastro">
      <label for="email">E-mail</label>
      <input type="email" name="email" placeholder="Ex.: leticia@gmail.com" required>
    </div>

    <div class="dadosCadastro">
      <label for="profissao">Profissão</label>
      <input type="text" name="profissao" placeholder="Ex.: Desenvolvedora Web" required>
    </div>

    <div class="dadosCadastro">
      <label for="telefone">Telefone para contato</label>
      <input type="tel" name="telefone" placeholder="Ex.: (11) 4033-2019" maxlength="14">
    </div>

    <div class="dadosCadastro">
      <label for="celular">Celular para contato</label>
      <input type="tel" name="celular" placeholder="Ex.: (11) 98493-2039" maxlength="15">
    </div>

    <div class="formCheckbox">
      <input type="checkbox" name="checkCelular">
      <label for="checkCelular">Número de celular possui Whatsapp</label>
    </div>
    <div class="formCheckbox">
      <input type="checkbox" name="checkEmail">
      <label for="checkEmail">Enviar notificações por E-mail</label>
    </div>
    <div class="formCheckbox">
      <input type="checkbox" name="checkSms">
      <label for="checkSms">Enviar notificações por SMS</label>
    </div>

    <button type="submit" name="cadastrar">Cadastrar contato</button>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>E-mail</th>
        <th>Contato</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $conn = new mysqli('localhost', 'root', '', 'cadastro_alphacode');
        $query = "SELECT * FROM dados";
        $result = $conn->query($query);

        function contatoFormatado($numero) {
          $numero = preg_replace('/\D/', '', $numero);
          if (strlen($numero) === 11) {
              return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $numero);
          } elseif (strlen($numero) === 10) {
              return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $numero);
          }
          return $numero;
      }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['nome']}</td>";
                echo "<td>{$row['data_nascimento']}</td>";
                echo "<td>{$row['email']}</td>";
                
                if (!empty($row['celular'])) {
                    echo "<td>" . contatoFormatado($row['celular']) . "</td>";
                } else if (!empty($row['telefone'])) {
                    echo "<td>" . contatoFormatado($row['telefone']) . "</td>";
                } else {
                    echo "<td>Nenhum contato disponível</td>";
                }
                echo "<td>
                    <a href='editar.php?id={$row['id']}' class='edit'><img src=\"assets/editar.png\" alt=\"Editar\"></a>
                    <a href='deletar.php?id={$row['id']}' class='delete'> <img src=\"assets/excluir.png\" alt=\"Excluir\"></a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td>Nenhum dado encontrado</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
  </table>


  <footer>
    <p>Termos | Políticas</p>
    <p>©Copyright 2022 | Desenvolvido por</p>
    <img src="./assets/logo_rodape_alphacode.png">
    <p>©Alphacode IT Solutions 2022</p>
  </footer>
  <script>
  $(document).ready(function() {
    Inputmask({
      "mask": "(99) 9999-9999"
    }).mask(document.querySelector('input[name="telefone"]'));

    Inputmask({
      "mask": "(99) 99999-9999"
    }).mask(document.querySelector('input[name="celular"]'));
  });
  </script>
</body>

</html>