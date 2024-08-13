<?php
// Inicia a sessão. Isso é necessário para acessar as variáveis de sessão.
session_start();

// Inclui o arquivo de conexão com o banco de dados. Esse arquivo deve conter as credenciais e a lógica para conectar ao banco de dados.
include 'conexao.php';

// Verifica se o usuário está autenticado, verificando se a variável de sessão 'usuario_id' está definida.
// Se a variável não estiver definida, redireciona o usuário para a página de login.
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../html/login.html");
    exit();
}

// Obtém o ID do usuário da variável de sessão.
$usuario_id = $_SESSION['usuario_id'];

// Prepara a consulta SQL para buscar os dados do usuário na tabela 'usuarios' com base no ID do usuário.
// Usa uma instrução preparada para evitar SQL Injection.
$sql = "SELECT nome, email, telefone, endereco FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);

// Liga o parâmetro da consulta à variável '$usuario_id'. O tipo 'i' indica que o parâmetro é um inteiro.
$stmt->bind_param("i", $usuario_id);

// Executa a consulta SQL.
$stmt->execute();

// Obtém o resultado da consulta.
$result = $stmt->get_result();

// Verifica se a consulta retornou algum resultado. Se sim, obtém os dados do usuário.
// Caso contrário, redireciona o usuário para a página de erro ou de não encontrado (lost.html).
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    $nome = $usuario['nome'];
    $email = $usuario['email'];
    $telefone = $usuario['telefone'];
    $endereco = $usuario['endereco'];
} else {
    header("Location: ../html/lost.html");
    exit();
}

// Fecha a instrução preparada para liberar recursos.
$stmt->close();

// Fecha a conexão com o banco de dados.
$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela do Usuário</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../assets/Cat and dog-cuate 1.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/usuario.css">
</head>
<body>
  <div class="container">
    <div class="perfil">
      <div class="cabecalho-perfil">
        <img src="../assets/user-3296 (1).png" alt="" class="imagem-perfil">
        <div class="container-texto-perfil">
          <h1 class="titulo-perfil"><?php echo htmlspecialchars($nome); ?></h1>
          <p class="email-perfil"><?php echo htmlspecialchars($email); ?></p>
          <p class="telefone-perfil"><?php echo htmlspecialchars($telefone); ?></p>
          <p class="endereco-perfil"><?php echo htmlspecialchars($endereco); ?></p>
        </div>
      </div>
      <div class="menu">
        <a href="#" class="link-menu"><i class="fa-solid fa-circle-user icone-menu"></i>Conta</a>
        <a href="../phplogout.php" class="link-menu"><i class="fa-solid fa-right-from-bracket icone-menu"></i>Sair da conta</a>
      </div>
    </div>

    <form class="conta" action="atualizar_usuario.php" method="POST">
      <div class="cabecalho-conta">
        <h1 class="titulo-conta">Configuração da conta</h1>
        <div class="container-botoes">
          <button type="button" class="botao-cancelar">Cancelar</button>
          <button type="submit" class="botao-salvar">Salvar</button>
        </div>
      </div>

      <div class="edicao-conta">
        <div class="container-input">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($nome); ?>" required />
        </div>
        <div class="container-input">
          <label>Telefone</label>
          <input type="text" name="telefone" placeholder="Telefone" value="<?php echo htmlspecialchars($telefone); ?>" required />
        </div>
      </div>

      <div class="edicao-conta">
        <div class="container-input">
          <label>Email</label>
          <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required />
        </div>
        <div class="container-input">
          <label>Senha</label>
          <input type="password" name="senha" placeholder="Senha" required />
        </div>
      </div>

      <div class="edicao-conta">
        <div class="container-input">
          <label>Endereço</label>
          <textarea name="endereco" placeholder="Endereço"><?php echo htmlspecialchars($endereco); ?></textarea>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
