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
        <a class="editar" href="editar.php">EDITAR</a>
        <a class="excluir" href="excluir.php">EXCLUIR</a>
        <?php if ($usuarios): ?>
            <div class="usuarios-quadrado">
                
                <?php foreach ($usuarios as $usuario): ?>
                    <div class="usuarios-quadrado2">
                        <p><b>ID:</b> <?php echo $usuario['id_usuario']; ?></p>
                        <p><b>Nome:</b> <?php echo $usuario['nome']; ?></p>
                        <p><b>Telefone:</b> <?php echo $usuario['telefone']; ?></p>
                        <p><b>Email:</b> <?php echo $usuario['email']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <p>Nenhum usuário encontrado.</p>
    <?php endif; ?>
</body>
</html>
