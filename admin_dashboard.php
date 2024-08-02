<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Home Administrador</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="barra-lateral">
        <h2>Pets Home Administrador</h2>
        <ul>
        <li><a href="dashboard_administrador.php">Início</a></li>
        <li><a href="logout_adm.php">Sair</a></li>
        </ul>
    </div>
    <div class="conteudo-principal">
        <section id="usuarios">
            <h3>Usuários</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'listar_usuarios.php'; ?>
                </tbody>
            </table>
        </section>
        <section id="animais">
            <h3>Animais</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Espécie</th>
                        <th>Idade</th>
                        <th>Descrição</th>
                        <th>Gênero</th>
                        <th>Foto</th>
                        <th>Opção de Compra</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'listar_animais.php'; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
