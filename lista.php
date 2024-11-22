<?php
require_once 'usuario.php';

$usuario = new Usuario();
$usuario->conectar("localhost", "crud", "root", "");

if ($usuario->msgErro == "") {
    $sql = $usuario->getPDO()->prepare("SELECT id_usuario, nome, telefone, email FROM usuario");
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $usuarios = false;
    }
} else {
    echo "Erro ao conectar ao banco de dados.";
    $usuarios = false;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Cadastrados</title>
    <link rel="stylesheet" href="../CRUD/styles/lista.css">
</head>
<body>
    <div class="fundo-lista">
        <a class="link-voltar" href="login.php">VOLTAR</a>
        <h2>Usuários Cadastrados</h2>
        <?php if ($usuarios): ?>
            <div class="usuarios-quadrado">
                <?php foreach ($usuarios as $usuario): ?>
                    <div class="usuarios-quadrado2">
                        <p><strong>ID:</strong> <?php echo $usuario['id_usuario']; ?></p>
                        <p><strong>Nome:</strong> <?php echo $usuario['nome']; ?></p>
                        <p><strong>Telefone:</strong> <?php echo $usuario['telefone']; ?></p>
                        <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
                    </div>
                        <!--<div class="editar">editar

                        </div>
                        <div class="excluir">excluir

                        </div>-->
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <p>Nenhum usuário encontrado.</p>
    <?php endif; ?>
</body>
</html>
