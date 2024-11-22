<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area do cadastro</title>
    <link rel="stylesheet" href="../CRUD/styles/cadastro.css">
</head>
<body>
    <div class="fundo">
        <h2>CADASTRO DE USUÁRIO</h2>
            <form class="quadrado-fundo" action="" method="post">
                <label>Nome:</label>
                <input class="caixa-nome" type="text" name="nome" id="" placeholder="Digite o seu nome.">
                <label>Telefone:</label>
                <input class="caixa-telefone" type="tel" name="tel" id="" placeholder="Digite o seu telefone.">
                <label>Email:</label>
                <input class="caixa-email" type="email" name="email" id="" placeholder="Digite o seu email.">
                <label>Senha:</label>
                <input class="caixa-senha" type="password" name="senha" id="" placeholder="Confirme a sua senha.">
                <label>Confirmar Senha</label>
                <input class="caixa-confsenha" type="password" name="confSenha" id="" placeholder="Repita sua senha">
                <input class="cadastrar" type="submit" value="CADASTRAR">
                <a class="link-voltar" href="login.php">VOLTAR</a>
            </form>
        </div>
        <?php
        if (isset($_POST['nome'])) {
            $nome = $_POST['nome'];
            $telefone = $_POST['tel'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confSenha = addslashes($_POST['confSenha']);

            if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha)) {
                $usuario->conectar("localhost", "crud", "root", "");

                if ($usuario->msgErro == "") {
                    if ($senha == $confSenha) {
                        if ($usuario->cadastrar($nome, $telefone, $email, $senha)) {
                            echo "Cadastrado com sucesso!";
                        } else {
                            echo "Erro: Email já cadastrado.";
                        }
                    } else {
                        echo "Erro: Senhas não conferem.";
                    }
                } else {
                    echo "Erro de conexão: " . $usuario->msgErro;
                }
            } else {
                echo "Erro: Preencha todos os campos.";
            }
        }
    ?>
</body>
</html>