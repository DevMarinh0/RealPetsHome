<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Home Administrador</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>
    <div class="barra-lateral">
        <h2>Pets Home Administrador</h2>
        <ul>
            <li><a href="../html/login_adm.html">Início</a></li>
            <li><a href="../php/logout_adm.php">Sair</a></li>
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
                    <?php include '../php/listar_usuarios.php'; ?>
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
                    <?php include '../php/listar_animais.php'; ?>
                </tbody>
            </table>
        </section>
    </div>
    
    <!-- Script para confirmação de ações -->
    <script>
        // Função para confirmar exclusão
        function confirmarExclusao(event) {
            if (!confirm("Tem certeza que deseja excluir este item?")) {
                event.preventDefault(); // Cancela a ação se o usuário não confirmar
            }
        }

        // Função para confirmar edição
        function confirmarEdicao(event) {
            if (!confirm("Tem certeza que deseja editar este item?")) {
                event.preventDefault(); // Cancela a ação se o usuário não confirmar
            }
        }

        // Seleciona todos os botões de exclusão e edição e adiciona o evento de clique
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', confirmarExclusao);
        });

        document.querySelectorAll('.btn-edit').forEach(function(button) {
            button.addEventListener('click', confirmarEdicao);
        });
    </script>
</body>
</html>
